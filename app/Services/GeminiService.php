<?php

namespace App\Services;

use App\Models\Conversation;
use App\Models\District;
use App\Models\Place;
use App\Models\Placetype;
use Gemini;
use Gemini\Data\Content;
use Gemini\Enums\Role;

class GeminiService
{
    protected $client;

    public function __construct()
    {
        //

        $apiKey = config('services.ai.gemini_api_key');

        if (! $apiKey) {
            // يمكن تغيير هذا إلى Exception مخصص إذا لزم الأمر
            throw new \Exception("Gemini API key is missing. Please check config('services.ai.gemini_api_key').");
        }

        // الطريقة الصحيحة لإنشاء العميل في الإصدارات الحديثة
        $this->client = Gemini::client(config('services.ai.gemini_api_key'));
    }

    /**
     * معالجة استفسار المستخدم وتوليد رد من Gemini.
     */
    public function ask(array $input)
    {
        // 1. إيجاد أو إنشاء جلسة المحادثة
        $conversation = $this->findOrCreateConversation($input);

        // 2. جمع بيانات السياق من قاعدة البيانات (RAG-like Context)

        // **التعديل 1: استخدام join() بدلاً من implode() بعد map()**
        $districts = District::all()->map(fn ($d) => $d->name)->join("\n");
        $placetypes = Placetype::all()->map(fn ($d) => $d->name)->join("\n");
        $places = Place::all()->map(fn ($h) => "{$h->name} (المنطقة: {$h->district_id}, النوع: {$h->placetype_id}): {$h->description}")->join("\n");

        $context = "المعلومات السياحية المتاحة: \n\nالمناطق:\n$districts\n\nانواع الاماكن:\n$placetypes\n\nالاماكن:\n$places";

        // 3. تحضير رسائل المحادثة (للذاكرة)

        // استرجاع الرسائل السابقة وتحويلها إلى كائنات Content
        $messages = $conversation->messages->map(function ($message) {
            // استخدام الدور (Role) لتحديد من أرسل الرسالة
            return Content::parse($message->content, Role::from($message->role));
        })->toArray();

        // رسالة المستخدم الحالية مع دمج سياق قاعدة البيانات

        // 4. حفظ رسالة المستخدم في قاعدة البيانات
        $conversation->messages()->create([
            'role' => Role::USER,
            'content' => $input['message'], // نحفظ الرسالة الأصلية بدون السياق المدمج
        ]);

        // 5. بناء رسالة المستخدم النهائية وإضافتها للمحادثة
        // $messages[] = Content::parse($userPromptWithContext, Role::USER);

        // 6. تعريف تعليمات النظام
        $systemInstruction = 'أنت مساعد سياحي خبير. يجب أن تكون إجاباتك ودودة وتستند حصراً إلى "المعلومات السياحية المتاحة".';
        $systemInstruction .= "لذلك استخدم السياق التالي للإجابة بدقة\n";
        $systemInstruction .= "\n\n$context";

        // **التعديل 2: استخدام generativeModel() و generateContent()**
        // 7. توليد الرد من Gemini
        try {
            // **التعديل لحل خطأ systemInstruction()**: استخدام withSystemInstruction() على النموذج
            $chat = $this->client->generativeModel(model: 'gemini-2.5-flash')
                ->withSystemInstruction(Content::parse($systemInstruction, Role::USER)) // تم نقل التعليمات إلى هنا
                ->startChat($messages);

            $response = $chat->sendMessage($input['message']);

            $assistantText = $response->text();

        } catch (\Exception $e) {
            $assistantText = 'عذراً، حدث خطأ أثناء محاولة الاتصال بخدمة الذكاء الاصطناعي. الرجاء المحاولة مرة أخرى.';
        }

        // 7. حفظ رسالة المساعد
        $conversation->messages()->create([
            'role' => Role::MODEL,
            'content' => $assistantText,
        ]);

        return [
            'reply' => $assistantText,
            'conversation_id' => $conversation->id,
        ];
    }

    /**
     * Find or create a conversation.
     *
     * If the conversation ID is given, this method will try to find a conversation with the given ID.
     * If no conversation with the given ID exists, a new conversation will be created with the given session key.
     *
     * If the conversation ID is not given, this method will try to find a conversation with the given session key.
     * If no conversation with the given session key exists, a new conversation will be created with the given session key.
     *
     * @param  array  $input
     * @return \App\Models\Conversation
     */
    protected function findOrCreateConversation($input)
    {
        if (! empty($input['conversation_id'])) {
            return Conversation::find($input['conversation_id']) ?? Conversation::create(['session_key' => $input['session_key'] ?? null]);
        }

        return Conversation::firstOrCreate(['session_key' => $input['session_key'] ?? null]);
    }
}

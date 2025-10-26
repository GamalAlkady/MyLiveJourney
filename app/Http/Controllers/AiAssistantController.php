<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Services\GeminiService;
use Illuminate\Http\Request;

class AiAssistantController extends Controller
{
    public function index(GeminiService $service){

        // return Conversation::firstOrCreate(['id'=>''],['session_key' => 'session_key']);

        $answer = $service->ask(['message'=>'hello']);

        return $answer;
    }


  public function chat(Request $request, GeminiService $service)
    {
        // sleep(2);
        // return response()->json(['reply'=>'success']);

        $validatedData = $request->validate([
            'message' => 'required|string',
            'conversation_id'=>'nullable|int',
            'session_key'=>'nullable|string'
        ]);

        $answer = $service->ask($validatedData);

        return response()->json ($answer);
    }
}

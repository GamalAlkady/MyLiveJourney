<style>
    /* تضمين الأنماط المخصصة الضرورية لتحديد الموضع والرسوم المتحركة */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');

    #ai-chat-component-wrapper {
        font-family: 'Inter', sans-serif;
        z-index: 1100;
    }

    /* تحديد الموضع الثابت لوضعية RTL (الجانب الأيسر من الشاشة) */
    .chat-icon-fixed,
    .chat-window-fixed {
        position: fixed;
        left: 1.5rem;
        /* 24px */
        bottom: 1.5rem;
        z-index: 1100;
    }

    #ai-assistant-icon {
        /* الشفافية الأولية (70%) */
        opacity: 0.7;
        /* إضافة خاصية الانتقال (transition) لتشمل opacity لجعل الظهور سلسًا */
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out, opacity 0.3s ease-in-out;
    }

    #ai-assistant-icon:hover {
        /* جعل الزر معتمًا بالكامل (100%) */
        opacity: 1;
        /* إضافة تأثير حركة خفيفة للبروز */
        transform: scale(1.1);
        /* تعزيز الظل عند التأشير */
        box-shadow: 0 15px 25px -5px rgba(0, 0, 0, 0.2), 0 5px 10px -5px rgba(0, 0, 0, 0.1);
    }

    /* انتقالات نافذة الدردشة */
    #ai-chat-window {
        transform: scale(0);
        opacity: 0;
        transform-origin: bottom left;
        transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        max-height: 90vh;
        z-index: 1200;
    }

    #ai-chat-window.open {
        transform: scale(1);
        opacity: 1;
    }

    /* جماليات فقاعات الرسائل */
    .msg-user-bubble {
        border-bottom-left-radius: 0 !important;
    }

    .msg-ai-bubble {
        border-bottom-right-radius: 0 !important;
    }

    /* رسوم متحركة لمؤشر الكتابة */
    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }
    }

    .animate-pulse {
        animation: pulse 1.5s infinite;
    }

    .delay-100 {
        animation-delay: 0.1s;
    }

    .delay-200 {
        animation-delay: 0.2s;
    }

    .card-header::after {
        content: none;
    }

    /* تعديلات الاستجابة للأجهزة المحمولة */
    @media (max-width: 575.98px) {
        #ai-chat-window.open {
            width: 100% !important;
            height: 90% !important;
            left: 0 !important;
            bottom: 0 !important;
            max-width: none !important;
            max-height: none !important;
            border-radius: 0 !important;
        }

        #ai-chat-window.open .card-header,
        #ai-chat-window.open .card-footer {
            border-radius: 0 !important;
        }
    }
</style>
<div id="ai-chat-component-wrapper">
    <!-- 1. أيقونة المساعد العائمة (RTL: أسفل اليسار) -->
    <button id="ai-assistant-icon" 
            class="chat-icon-fixed btn p-0 border-0 text-white rounded-circle shadow-lg 
                   d-flex align-items-center justify-content-center" 
            style="width: 40px; height: 40px; 
                   background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%); 
                   outline: 4px solid rgba(79, 70, 229, 0.3); outline-offset: 2px;">

        <!-- أيقونة روبوت عصرية (SVG) -->
        <i class="fa fa-robot " style="font-size: 1.5rem;"></i>
    </button>

    <!-- 2. واجهة نافذة الدردشة (RTL: أسفل اليسار) -->
    <div id="ai-chat-window" class="chat-window-fixed card shadow-lg d-flex flex-column justify-content-between"
        style="width: 100%; max-width: 380px; height: 500px; border-radius: 0.5rem;">

        <!-- الرأس -->
        <div class="card-header p-3 text-white d-flex justify-content-between align-items-center"
            style="background: linear-gradient(90deg, #3b82f6 0%, #4f46e5 100%); border-radius: calc(0.5rem - 1px) calc(0.5rem - 1px) 0 0;">
            <div class="d-flex align-items-center">
                <div class="position-relative mr-2">
                    <span class="p-1 bg-success rounded-circle position-absolute" style="top: -2px; left: -2px;"></span>
                </div>
                <h3 class="h6 mb-0 font-weight-bold">مساعد السياحة الذكي</h3>
            </div>
            <div>
                <button id="close-chat-btn" class="btn btn-sm btn-link text-white p-1" style="opacity: 0.8;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        style="width: 20px; height: 20px; stroke-width: 2;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- حاوية الرسائل -->
        <div id="messages-container" class="card-body flex-grow-1 p-3 overflow-auto small"
            style="background-color: #fcfcfc;">
            <!-- رسالة الترحيب الأولية -->
            <div class="mb-3 d-flex justify-content-start">
                <div class="p-3 bg-light text-dark rounded msg-ai-bubble shadow-sm mr-auto" style="max-width: 85%;">
                    أهلاً بك! أنا مساعدك السياحي المعتمد. اسألني عن المناطق أو الأماكن المتاحة وسأجيبك فوراً.
                </div>
            </div>
        </div>

        <!-- حقل الإدخال (الذيل) -->
        <div class="card-footer p-3 bg-white border-top"
            style="border-radius: 0 0 calc(0.5rem - 1px) calc(0.5rem - 1px);">
            <form id="chat-form" class="d-flex align-items-center">
                <!-- استخدام توجيه Blade الصحيح لرمز CSRF -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <input type="text" id="user-input" placeholder="اكتب سؤالك هنا..."
                    class="form-control rounded-pill flex-grow-1 mr-2 small" required>
                <input type="hidden" id="conversation-id" value="">

                <!-- زر الإرسال مع أيقونة التحميل -->
                <button type="submit" id="send-btn"
                    class="btn btn-primary rounded-circle p-2 d-flex align-items-center justify-content-center"
                    style="width: 40px; height: 40px;">

                    <!-- 1. أيقونة الإرسال (تُعرض بشكل افتراضي) -->
                    <span id="send-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            style="width: 20px; height: 20px; stroke-width: 2;">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                    </span>

                    <!-- 2. مؤشر التحميل (يُخفى بشكل افتراضي) -->
                    <span id="loading-spinner" class="spinner-border spinner-border-sm" role="status"
                        aria-hidden="true" style="width: 18px; height: 18px; display: none;"></span>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- منطق JavaScript للمكون -->
<script>
    // متغير للتحكم في عملية الفحص المتكرر
    let initializationCheck;

    // دالة للتحقق من تحميل jQuery وتشغيل منطق المكون
    const checkAndInitialize = () => {
        // التحقق من jQuery (الاعتمادية المطلوبة لـ Bootstrap)
        if (typeof jQuery === 'undefined') {
            // إذا لم يتم تحميل jQuery، استمر في التحقق
            console.warn('Waiting for jQuery to load...');
            return;
        }

        // *****************************************************************
        // إذا تم الوصول إلى هنا، فـ jQuery جاهز.
        // إيقاف عملية الفحص المتكرر وبدء تهيئة المكون.
        clearInterval(initializationCheck);
        console.log('jQuery loaded. Initializing chat component.');
        // *****************************************************************

        const icon = document.getElementById('ai-assistant-icon');
        const chatWindow = document.getElementById('ai-chat-window');
        const closeBtn = document.getElementById('close-chat-btn');
        const chatForm = document.getElementById('chat-form');
        const userInput = document.getElementById('user-input');
        const messagesContainer = document.getElementById('messages-container');
        const sendBtn = document.getElementById('send-btn');
        const sendIcon = document.getElementById('send-icon');
        const loadingSpinner = document.getElementById('loading-spinner');
        let conversation_id = localStorage.getItem('conversation_id') || null;
        const session_key = localStorage.getItem('session_key') || crypto.randomUUID();

        // ******* وظائف التحكم في حالة التحميل *******
        const setSendingState = (isSending) => {
            if (isSending) {
                sendBtn.disabled = true;
                userInput.disabled = true;
                sendIcon.style.display = 'none';
                loadingSpinner.style.display = 'inline-block';
            } else {
                sendBtn.disabled = false;
                userInput.disabled = false;
                sendIcon.style.display = 'inline-block';
                loadingSpinner.style.display = 'none';
            }
        };
        // ****************************************

        // دالة لتبديل حالة نافذة الدردشة
        const toggleChat = () => {
            chatWindow.classList.toggle('open');
            // applyResponsiveStyles();

            if (chatWindow.classList.contains('open')) {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
        };

        // مستمعي الأحداث للأيقونة وزر الإغلاق
        icon.addEventListener('click', toggleChat);
        closeBtn.addEventListener('click', toggleChat);
        // window.addEventListener('resize', applyResponsiveStyles);

        // دالة لإضافة فقاعة رسالة
        const appendMessage = (text, sender) => {
            const messageContainer = document.createElement('div');
            const messageElement = document.createElement('div');

            messageContainer.className = 'mb-3 d-flex';

            if (sender === 'user') {
                messageElement.className =
                    'p-3 bg-primary text-white rounded msg-user-bubble shadow-sm ml-auto';
                messageContainer.classList.add('justify-content-end');
            } else {
                messageElement.className = 'p-3 bg-light text-dark rounded msg-ai-bubble shadow-sm mr-auto';
                messageContainer.classList.add('justify-content-start');
            }

            messageElement.style.maxWidth = '85%';
            messageElement.innerText = text;
            messageContainer.appendChild(messageElement);
            messagesContainer.appendChild(messageContainer);

            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        };

        // دالة لإظهار مؤشر "جاري التفكير" للمساعد
        const showThinkingIndicator = () => {
            const thinkingContainer = document.createElement('div');
            const thinkingMessage = document.createElement('div');
            thinkingContainer.id = 'thinking-indicator-container';
            thinkingContainer.className = 'mb-3 d-flex justify-content-start';

            thinkingMessage.id = 'thinking-indicator';
            thinkingMessage.className =
                'p-3 bg-light text-muted rounded msg-ai-bubble mr-auto shadow-sm small font-italic';
            thinkingMessage.style.maxWidth = 'fit-content';
            thinkingMessage.innerHTML =
                'جاري التفكير<span class="dot1 animate-pulse">.</span><span class="dot2 animate-pulse delay-100">.</span><span class="dot3 animate-pulse delay-200">.</span>';

            thinkingContainer.appendChild(thinkingMessage);
            messagesContainer.appendChild(thinkingContainer);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        };

        // دالة لإزالة مؤشر "جاري التفكير"
        const removeThinkingIndicator = () => {
            document.getElementById('thinking-indicator-container')?.remove();
        };

        // معالج إرسال نموذج الدردشة
        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const message = userInput.value.trim();
            if (!message) return;

            // 1. عرض رسالة المستخدم ومسح الإدخال
            appendMessage(message, 'user');
            const originalMessage = userInput.value;
            userInput.value = '';

            // 2. تفعيل حالة الإرسال (تعطيل الزر وإظهار المؤشر)
            setSendingState(true);
            showThinkingIndicator();

            try {
                // 3. إرسال الرسالة إلى الواجهة الخلفية لـ Laravel
                const response = await fetch('chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        message: originalMessage,
                        conversation_id,
                        session_key
                    })
                });

                const data = await response.json();

                // 4. تعطيل حالة الإرسال وإزالة مؤشر التفكير
                setSendingState(false);
                removeThinkingIndicator();

                if (response.ok && data.reply) {
                    // 5. عرض رد المساعد
                    appendMessage(data.reply, 'assistant');
                    localStorage.setItem('session_key', session_key);

                    // 6. تحديث معرف المحادثة
                    if (data.conversation_id) {
                        conversation_id = data.conversation_id;
                        localStorage.setItem('conversation_id', conversation_id);
                    }
                } else {
                    // 7. التعامل مع أخطاء API
                    appendMessage(data.message || 'عفواً، فشل الاتصال بالخدمة الذكية.', 'assistant');
                    console.error('API Error Response:', data);
                }

            } catch (error) {
                // 8. التعامل مع أخطاء الشبكة/الجلب
                setSendingState(false);
                removeThinkingIndicator();
                appendMessage('حدث خطأ في الاتصال بالخادم. تأكد من أن المسار /api/ask-assistant يعمل.',
                    'assistant');
                console.error('Fetch Error:', error);
            }
        });
    };

    // ابدأ بالتحقق كل 100 مللي ثانية
    initializationCheck = setInterval(checkAndInitialize, 100);
</script>

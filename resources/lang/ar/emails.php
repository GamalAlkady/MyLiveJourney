<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Emails Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used for various emails that
    | we need to display to the user. You are free to modify these
    | language lines according to your application's requirements.
    |
    */

    // Activate new user account email.
    'activationSubject'  => 'مطلوب تفعيل الحساب',
    'activationGreeting' => 'أهلاً بك!',
    'activationMessage'  => 'يجب عليك تفعيل بريدك الإلكتروني قبل أن تتمكن من استخدام جميع خدماتنا.',
    'activationButton'   => 'تفعيل',
    'activationThanks'   => 'شكراً لاستخدامك تطبيقنا!',

    // Goobye email.
    'goodbyeSubject'  => 'نأسف لمغادرتك...',
    'goodbyeGreeting' => 'مرحباً :username,',
    'goodbyeMessage'  => 'نحن نأسف جداً لرؤيتك تغادر. أردنا أن نخبرك بأن حسابك قد تم حذفه. شكراً للوقت الذي قضيناه معاً. لديك '.config('settings.restoreUserCutoff').' يوماً لاستعادة حسابك.',
    'goodbyeButton'   => 'استعادة الحساب',
    'goodbyeThanks'   => 'نأمل أن نراك مرة أخرى!',

];

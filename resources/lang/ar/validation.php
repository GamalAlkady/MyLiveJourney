<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'        => 'يجب قبول :attribute.',
    'active_url'      => ':attribute ليس رابط صالح.',
    'after'           => 'يجب أن يكون :attribute تاريخاً بعد :date.',
    'after_or_equal'  => 'يجب أن يكون :attribute تاريخاً بعد أو يساوي :date.',
    'alpha'           => 'يجب أن يحتوي :attribute على أحرف فقط.',
    'alpha_dash'      => 'يجب أن يحتوي :attribute على أحرف وأرقام وشرطات فقط.',
    'alpha_num'       => 'يجب أن يحتوي :attribute على أحرف وأرقام فقط.',
    'array'           => 'يجب أن يكون :attribute مصفوفة.',
    'before'          => 'يجب أن يكون :attribute تاريخاً قبل :date.',
    'before_or_equal' => 'يجب أن يكون :attribute تاريخاً قبل أو يساوي :date.',
    'between'         => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون حجم :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد أحرف :attribute بين :min و :max.',
        'array'   => 'يجب أن يحتوي :attribute على عدد عناصر بين :min و :max.',
    ],
    'boolean'        => 'يجب أن يكون حقل :attribute صحيحاً أو خاطئاً.',
    'confirmed'      => 'تأكيد :attribute غير متطابق.',
    'date'           => ':attribute ليس تاريخاً صالحاً.',
    'date_format'    => ':attribute لا يتطابق مع التنسيق :format.',
    'different'      => 'يجب أن يكون :attribute و :other مختلفين.',
    'digits'         => 'يجب أن يحتوي :attribute على :digits رقم.',
    'digits_between' => 'يجب أن يحتوي :attribute على عدد أرقام بين :min و :max.',
    'dimensions'     => 'أبعاد صورة :attribute غير صالحة.',
    'distinct'       => 'حقل :attribute يحتوي على قيمة مكررة.',
    'email'          => 'يجب أن يكون :attribute بريداً إلكترونياً صالحاً.',
    'exists'         => ':attribute المحدد غير صالح.',
    'file'           => 'يجب أن يكون :attribute ملفاً.',
    'filled'         => 'يجب أن يحتوي حقل :attribute على قيمة.',
    'image'          => 'يجب أن يكون :attribute صورة.',
    'in'             => ':attribute المحدد غير صالح.',
    'in_array'       => 'حقل :attribute غير موجود في :other.',
    'integer'        => 'يجب أن يكون :attribute عدداً صحيحاً.',
    'ip'             => 'يجب أن يكون :attribute عنوان IP صالحاً.',
    'json'           => 'يجب أن يكون :attribute سلسلة JSON صالحة.',
    'max'            => [
        'numeric' => 'يجب ألا تكون قيمة :attribute أكبر من :max.',
        'file'    => 'يجب ألا يكون حجم :attribute أكبر من :max كيلوبايت.',
        'string'  => 'يجب ألا يزيد عدد أحرف :attribute عن :max.',
        'array'   => 'يجب ألا يحتوي :attribute على أكثر من :max عنصر.',
    ],
    'mimes'     => 'يجب أن يكون :attribute ملفاً من نوع: :values.',
    'mimetypes' => 'يجب أن يكون :attribute ملفاً من نوع: :values.',
    'min'       => [
        'numeric' => 'يجب أن تكون قيمة :attribute على الأقل :min.',
        'file'    => 'يجب أن يكون حجم :attribute على الأقل :min كيلوبايت.',
        'string'  => 'يجب أن يحتوي :attribute على الأقل :min حرف.',
        'array'   => 'يجب أن يحتوي :attribute على الأقل :min عنصر.',
    ],
    'not_in'               => ':attribute المحدد غير صالح.',
    'numeric'              => 'يجب أن يكون :attribute رقماً.',
    'present'              => 'يجب أن يكون حقل :attribute موجوداً.',
    'regex'                => 'تنسيق :attribute غير صالح.',
    'required'             => 'حقل :attribute مطلوب.',
    'required_if'          => 'حقل :attribute مطلوب عندما تكون قيمة :other هي :value.',
    'required_unless'      => 'حقل :attribute مطلوب ما لم يكن :other في :values.',
    'required_with'        => 'حقل :attribute مطلوب عندما يكون :values موجوداً.',
    'required_with_all'    => 'حقل :attribute مطلوب عندما تكون كل قيم :values موجودة.',
    'required_without'     => 'حقل :attribute مطلوب عندما لا يكون :values موجوداً.',
    'required_without_all' => 'حقل :attribute مطلوب عندما لا تكون أي من قيم :values موجودة.',
    'same'                 => 'يجب أن يتطابق :attribute مع :other.',
    'size'                 => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size.',
        'file'    => 'يجب أن يكون حجم :attribute مساوياً لـ :size كيلوبايت.',
        'string'  => 'يجب أن يحتوي :attribute على :size حرف.',
        'array'   => 'يجب أن يحتوي :attribute على :size عنصر.',
    ],
    'string'   => 'يجب أن يكون :attribute سلسلة نصية.',
    'timezone' => 'يجب أن يكون :attribute منطقة زمنية صالحة.',
    'unique'   => ':attribute تم استخدامه من قبل.',
    'uploaded' => 'فشل في رفع :attribute.',
    'url'      => 'تنسيق :attribute غير صالح.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
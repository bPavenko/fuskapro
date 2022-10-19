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

    'accepted' => 'Необхідно прийняти атрибут :attribute.',
    'accepted_if' => ':attribute має прийматися, коли :other є :value.',
    'active_url' => ':attribute не є дійсною URL-адресою.',
    'after' => ':attribute має бути датою після :date.',
    'after_or_equal' => ':attribute має бути датою після або дорівнювати :date.',
    'alpha' => ':attribute має містити лише літери.',
    'alpha_dash' => ':attribute має містити лише літери, цифри, тире та підкреслення.',
    'alpha_num' => ':attribute має містити лише літери та цифри.',
    'array' => ':attribute має бути масивом.',
    'before' => ':attribute має бути датою перед :date.',
    'before_or_equal' => ':attribute має бути датою, що передує або дорівнює :date.',
    'between' => [
        'numeric' => ':attribute має бути між :min та :max.',
        'file' => ':attribute має бути між :min і :max кілобайтами.',
        'string' => ':attribute має бути між символами :min і :max.',
        'array' => ':attribute має містити між елементами :min і :max.',
    ],
    'boolean' => 'Поле :attribute має мати значення true або false.',
    'confirmed' => 'Підтвердження :attribute не збігається.',
    'current_password' => 'Пароль неправильний.',
    'date' => ':attribute не є дійсною датою.',
    'date_equals' => ':attribute має бути датою, що дорівнює :date.',
    'date_format' => ':attribute не відповідає формату :format.',
    'declined' => ':attribute має бути відхилено.',
    'declined_if' => ':attribute має бути відхилено, якщо :other є :value.',
    'different' => ':attribute та :other мають бути різними.',
    'digits' => ':attribute має бути :digits цифрами.',
    'digits_between' => ':attribute має бути між :min та :max цифрами.',
    'dimensions' => ':attribute має недійсні розміри зображення.',
    'distinct' => 'Поле :attribute має повторюване значення.',
    'email' => ':attribute має бути дійсною електронною адресою.',
    'ends_with' => ':attribute має закінчуватися одним із таких: :values.',
    'enum' => 'Вибраний :attribute недійсний.',
    'exists' => 'Вибраний :attribute недійсний.',
    'file' => ':attribute має бути файлом.',
    'filled' => 'Поле :attribute має містити значення.',
    'gt' => [
        'numeric' => ':attribute має бути більшим за :value.',
        'file' => ':attribute має бути більшим за :value кілобайт.',
        'string' => ':attribute має бути більшим за :value.',
        'array' => ':attribute має містити більше ніж :value елементів.',
    ],
    'gte' => [
        'numeric' => ':attribute має бути більшим або дорівнювати :value.',
        'file' => ':attribute має бути більшим або дорівнювати :value кілобайтам.',
        'string' => ':attribute має бути більше або дорівнювати символам :value.',
        'array' => ':attribute повинен містити елементи :value або більше.',
    ],
    'image' => ':attribute має бути зображенням.',
    'in' => 'Вибраний :attribute недійсний.',
    'in_array' => 'Поле :attribute не існує в :other.',
    'integer' => ':attribute має бути цілим числом.',
    'ip' => ':attribute має бути дійсною IP-адресою.',
    'ipv4' => ':attribute має бути дійсною адресою IPv4.',
    'ipv6' => ':attribute має бути дійсною адресою IPv6.',
    'json' => ':attribute має бути дійсним рядком JSON.',
    'lt' => [
        'numeric' => ':attribute має бути меншим за :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'max' => [
        'numeric' => 'The :attribute must not be greater than :max.',
        'file' => 'The :attribute must not be greater than :max kilobytes.',
        'string' => 'The :attribute must not be greater than :max characters.',
        'array' => 'The :attribute must not have more than :max items.',
    ],
    'mimes' => 'The :attribute must be a file of type: :values.',
    'mimetypes' => 'The :attribute must be a file of type: :values.',
    'min' => [
        'numeric' => ':attribute має бути принаймні :min.',
        'file' => ':attribute має бути не менше :min кілобайт.',
        'string' => ':attribute має містити принаймні :min символів.',
        'array' => ':attribute має містити принаймні :min елементів.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'Формат :attribute недійсний.',
    'required' => 'Поле :attribute є обов’язковим.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'The :attribute field is required unless :other is in :values.',
    'required_with' => 'The :attribute field is required when :values is present.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same' => 'The :attribute and :other must match.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => 'The :attribute must be a string.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'The :attribute has already been taken.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute must be a valid URL.',
    'uuid' => 'The :attribute must be a valid UUID.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'phone' => 'телелефон',
        'password' => 'пароль',
        'gender' => 'стать',
        'city' => 'місто',
        'name' => "ім'я",
        'surname' => 'прізвище',
        'birth_date' => 'дата народження',
    ],

];

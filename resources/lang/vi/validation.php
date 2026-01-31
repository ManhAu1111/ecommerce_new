<?php

return [
    'required' => ':attribute không được để trống.',
    'string' => ':attribute phải là chuỗi.',
    'min' => [
        'string' => ':attribute phải có ít nhất :min ký tự.',
    ],
    'confirmed' => ':attribute xác nhận không khớp.',

    // 'current_password' => 'Mật khẩu hiện tại không đúng.',
    'current_password.current_password' => 'Mật khẩu hiện tại không đúng.',

    'attributes' => [
        'current_password' => 'Mật khẩu hiện tại',
        'password' => 'Mật khẩu mới',
        'password_confirmation' => 'Xác nhận mật khẩu',
    ],
];

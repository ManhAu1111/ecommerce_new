<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;

class PasswordController extends Controller
{
    public function update(Request $request): RedirectResponse
    {
        // 1. Check thiếu dữ liệu → báo 1 lỗi chung
        if (
            empty($request->current_password) ||
            empty($request->password) ||
            empty($request->password_confirmation)
        ) {
            throw ValidationException::withMessages([
                'general' => 'Vui lòng nhập đầy đủ thông tin',
            ]);
        }

        // 2. Validate chi tiết khi đã nhập đủ
        $validated = $request->validate(
            [
                'current_password' => ['required', 'current_password'],
                'password' => ['required', 'min:8', 'confirmed'],
            ],
            [
                'current_password.current_password' => 'Mật khẩu hiện tại không đúng',
                'password.min' => 'Mật khẩu mới phải có ít nhất :min ký tự',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp',
            ]
        );

        // 3. Update password
        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('success', 'Đổi mật khẩu thành công');
    }
}

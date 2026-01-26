<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|lowercase|email:rfc,dns|max:255',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                // 'password' => [
                //     'required',
                //     'confirmed',
                //     'digits:6',
                // ],
            ],
            [
                'name.required' => 'Vui lòng nhập họ tên.',
                'email.required' => 'Vui lòng nhập email.',
                'email.email' => 'Email không đúng định dạng.',
                'email.dns' => 'Tên miền email không tồn tại.',
                'password.required' => 'Vui lòng nhập mật khẩu.',
                'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
                'password.confirmed' => 'Mật khẩu nhập lại không khớp.',
            ]
        );

        $user = User::where('email', $request->email)->first();

        // Scenario A: Account Exists & Verified
        if ($user && $user->email_verified_at) {
            return back()->withErrors(['email' => 'Tài khoản này đã được đăng ký. Vui lòng đăng nhập.']);
        }

        $otp = (string) rand(100000, 999999);

        // Scenario B: Account Exists but Unverified (Retry)
        if ($user) {
            $user->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'verification_code' => $otp,
            ]);
        }
        // Scenario C: New User
        else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'verification_code' => $otp,
            ]);
        }

        // Send OTP Email
        Mail::to($user)->send(new OtpMail($otp));

        // Redirect to OTP verification page
        session(['otp_email' => $request->email]); // Lưu email vào session với tên 'otp_email'
        return redirect()->route('verification.otp');
    }

    public function verify_form()
    {
        $email = session('otp_email');

        if (!$email) {
            return redirect()->route('register');
        }

        return Inertia::render('Auth/VerifyOtp', [
            'email' => $email
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'otp' => 'required|size:6',
            ],
            [
                'otp.required' => 'Vui lòng nhập mã OTP.',
                'otp.size' => 'Mã OTP bắt buộc phải có đúng 6 ký tự.',
            ]
        );

        $user = User::where('email', $request->email)
            ->where('verification_code', $request->otp)
            ->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Mã OTP không hợp lệ.']);
        }

        $user->update([
            'email_verified_at' => now(),
            'verification_code' => null
        ]);

        session()->forget('otp_email');

        // Do not auto-login. Redirect to Login with success message.
        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
}

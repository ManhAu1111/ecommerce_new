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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

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
        return redirect()->route('verification.otp')->with('email', $request->email);
    }

    public function verify_form()
    {
        return Inertia::render('Auth/VerifyOtp', [
            'email' => session('email')
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|size:6',
        ]);

        $user = User::where('email', $request->email)
            ->where('verification_code', $request->otp)
            ->first();

        if (!$user) {
            return back()->withErrors(['otp' => 'Mã OTP không hợp lệ hoặc Email không đúng.']);
        }

        $user->update([
            'email_verified_at' => now(),
            'verification_code' => null
        ]);

        // Do not auto-login. Redirect to Login with success message.
        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }
}

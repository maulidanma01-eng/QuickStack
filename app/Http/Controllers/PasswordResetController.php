<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ], [
            'email.exists' => 'Email tidak ditemukan di sistem QuickStack.',
        ]);

        $email = $request->email;
        $otp = random_int(100000, 999999);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => Hash::make($otp),
                'created_at' => now(),
            ]
        );

        Mail::raw(
            "Kode OTP reset password QuickStack kamu adalah: {$otp}\n\nKode ini berlaku selama 15 menit.\n\nJika kamu tidak meminta reset password, abaikan email ini.",
            function ($message) use ($email) {
                $message->to($email)
                    ->subject('Kode OTP Reset Password QuickStack');
            }
        );

        return redirect()->route('password.otp.form')
            ->with('status', 'Kode OTP sudah dikirim ke email kamu.')
            ->with('reset_email', $email);
    }

    public function showOtpForm(Request $request)
    {
        $email = session('reset_email');

        if (!$email) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Silakan masukkan email terlebih dahulu.']);
        }

        return view('auth.verify-otp', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp' => ['required', 'digits:6'],
        ], [
            'otp.digits' => 'OTP harus 6 digit.',
        ]);

        $resetData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetData) {
            return back()->withErrors([
                'otp' => 'OTP tidak ditemukan. Silakan kirim ulang OTP.',
            ]);
        }

        if (now()->diffInMinutes($resetData->created_at) > 15) {
            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->delete();

            return redirect()->route('password.request')
                ->withErrors(['email' => 'OTP sudah kedaluwarsa. Silakan minta OTP baru.']);
        }

        if (!Hash::check($request->otp, $resetData->token)) {
            return back()->withErrors([
                'otp' => 'OTP salah.',
            ]);
        }

        session([
            'otp_verified_email' => $request->email,
        ]);

        return redirect()->route('password.change.form');
    }

    public function showChangePasswordForm()
    {
        $email = session('otp_verified_email');

        if (!$email) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Verifikasi OTP terlebih dahulu.']);
        }

        return view('auth.change-password', compact('email'));
    }

    public function changePassword(Request $request)
    {
        $email = session('otp_verified_email');

        if (!$email) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Sesi reset password tidak valid.']);
        }

        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'password.confirmed' => 'Konfirmasi password tidak sama.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.request')
                ->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        $user->password = $request->password;
        $user->remember_token = Str::random(60);
        $user->save();

        DB::table('password_reset_tokens')
            ->where('email', $email)
            ->delete();

        session()->forget(['reset_email', 'otp_verified_email']);

        return redirect()->route('login')
            ->with('success', 'Password berhasil diubah. Silakan login dengan password baru.');
    }
}
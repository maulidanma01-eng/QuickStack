<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailVerificationController extends Controller
{
    public function notice(Request $request)
    {
        return view('auth.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('dashboard')->with('success', 'Email Anda berhasil diverifikasi!');
    }

    public function send(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('dashboard');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Link verifikasi baru telah dikirim ke alamat email Anda.');
    }
}

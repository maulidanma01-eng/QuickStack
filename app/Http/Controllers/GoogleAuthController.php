<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirect(Request $request)
    {
        $state = Str::random(40);

        $request->session()->put('google_oauth_state', $state);

        $query = http_build_query([
            'client_id' => config('services.google.client_id'),
            'redirect_uri' => config('services.google.redirect'),
            'response_type' => 'code',
            'scope' => 'openid email profile',
            'access_type' => 'offline',
            'prompt' => 'select_account',
            'state' => $state,
        ]);

        return redirect('https://accounts.google.com/o/oauth2/v2/auth?' . $query);
    }

    public function callback(Request $request)
    {
        if ($request->has('error')) {
            return redirect()->route('login')->withErrors([
                'email' => 'Login Google dibatalkan atau gagal.',
            ]);
        }

        if ($request->state !== $request->session()->pull('google_oauth_state')) {
            return redirect()->route('login')->withErrors([
                'email' => 'State Google tidak valid. Silakan coba login ulang.',
            ]);
        }

        $tokenResponse = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'client_id' => config('services.google.client_id'),
            'client_secret' => config('services.google.client_secret'),
            'redirect_uri' => config('services.google.redirect'),
            'grant_type' => 'authorization_code',
            'code' => $request->code,
        ]);

        if (!$tokenResponse->successful()) {
            return redirect()->route('login')->withErrors([
                'email' => 'Gagal mengambil token Google.',
            ]);
        }

        $accessToken = $tokenResponse->json('access_token');

        $googleUserResponse = Http::withToken($accessToken)
            ->get('https://www.googleapis.com/oauth2/v3/userinfo');

        if (!$googleUserResponse->successful()) {
            return redirect()->route('login')->withErrors([
                'email' => 'Gagal mengambil data akun Google.',
            ]);
        }

        $googleUser = $googleUserResponse->json();

$user = User::where('email', $googleUser['email'])->first();

if ($user) {
    $user->update([
        'name' => $googleUser['name'] ?? $user->name,
        'google_id' => $googleUser['sub'] ?? $user->google_id,
        'avatar' => $googleUser['picture'] ?? $user->avatar,
    ]);
} else {
    $user = User::create([
        'name' => $googleUser['name'] ?? 'User QuickStack',
        'email' => $googleUser['email'],
        'google_id' => $googleUser['sub'] ?? null,
        'avatar' => $googleUser['picture'] ?? null,
        'password' => Hash::make(Str::random(32)),
    ]);
}

Auth::login($user, true);

return redirect()->route('dashboard')
    ->with('success', 'Berhasil login dengan Google. Selamat datang, ' . $user->name . '!');
    }
}
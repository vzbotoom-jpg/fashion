<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    // ============================================================
    // LOGIN WITH GOOGLE
    // ============================================================
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();
            return $this->handleSocialUser($socialUser, 'google', false);
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Login dengan Google gagal. Silakan coba lagi.');
        }
    }

    // ============================================================
    // LOGIN WITH GITHUB
    // ============================================================
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback()
    {
        try {
            $socialUser = Socialite::driver('github')->user();
            return $this->handleSocialUser($socialUser, 'github', false);
        } catch (\Exception $e) {
            return redirect()->route('login')
                ->with('error', 'Login dengan GitHub gagal. Silakan coba lagi.');
        }
    }

    // ============================================================
    // REGISTER WITH GOOGLE (Tambahan)
    // ============================================================
    public function redirectToGoogleRegister()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleRegisterCallback()
    {
        try {
            $socialUser = Socialite::driver('google')->user();
            return $this->handleSocialUser($socialUser, 'google', true);
        } catch (\Exception $e) {
            return redirect()->route('register')
                ->with('error', 'Daftar dengan Google gagal. Silakan coba lagi.');
        }
    }

    // ============================================================
    // REGISTER WITH GITHUB (Tambahan)
    // ============================================================
    public function redirectToGithubRegister()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubRegisterCallback()
    {
        try {
            $socialUser = Socialite::driver('github')->user();
            return $this->handleSocialUser($socialUser, 'github', true);
        } catch (\Exception $e) {
            return redirect()->route('register')
                ->with('error', 'Daftar dengan GitHub gagal. Silakan coba lagi.');
        }
    }

    // ============================================================
    // HANDLE SOCIAL USER (Private Method)
    // ============================================================
    private function handleSocialUser($socialUser, $provider, $isRegister = false)
    {
        // Cek apakah user sudah ada
        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            // Buat user baru
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(uniqid()),
                'role' => 'customer',
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user);

        // Tentukan pesan sukses berdasarkan mode (login atau register)
        $message = $isRegister
            ? 'Akun berhasil dibuat! Selamat datang, ' . $user->name
            : 'Login berhasil! Selamat datang, ' . $user->name;

        return redirect()->route('home')->with('success', $message);
    }
}
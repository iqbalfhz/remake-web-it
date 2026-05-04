<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function authenticate(): void
    {
        $email = Str::lower($this->string('email'));

        $userExists = User::where('email', $email)->exists();

        if (! $userExists) {
            throw ValidationException::withMessages([
                'email' => 'Email tidak terdaftar dalam sistem.',
            ]);
        }

        $this->ensureIsNotRateLimited($email);

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            $this->recordFailedAttempt($email);

            throw ValidationException::withMessages([
                'email' => 'Password yang Anda masukkan salah.',
            ]);
        }

        if (! Auth::user()->is_approved) {
            Auth::logout();

            throw ValidationException::withMessages([
                'email' => 'Akun Anda belum disetujui oleh admin. Silakan tunggu konfirmasi.',
            ]);
        }

        if (! Auth::user()->is_active) {
            Auth::logout();

            throw ValidationException::withMessages([
                'email' => 'Akun Anda telah dinonaktifkan. Hubungi admin untuk informasi lebih lanjut.',
            ]);
        }

        $this->clearAttempts($email);
    }

    public function ensureIsNotRateLimited(string $email): void
    {
        $lockUntil = Cache::get($this->lockKey($email));

        if (! $lockUntil) {
            return;
        }

        $seconds = $lockUntil - now()->timestamp;

        if ($seconds <= 0) {
            Cache::forget($this->lockKey($email));
            $this->removeFromRegistry($email);

            return;
        }

        session()->flash('lock_until', $lockUntil);
        session()->flash('lock_seconds', $seconds);
        session()->flash('login_attempts', (int) Cache::get($this->attemptsKey($email), 0));

        $timeMsg = $seconds < 60 ? "{$seconds} detik" : ceil($seconds / 60).' menit';

        throw ValidationException::withMessages([
            'email' => "Akun ini sedang diblokir sementara. Coba lagi dalam {$timeMsg}.",
        ]);
    }

    private function recordFailedAttempt(string $email): void
    {
        $attempts = (int) Cache::get($this->attemptsKey($email), 0) + 1;
        Cache::put($this->attemptsKey($email), $attempts, now()->addDay());

        session()->flash('login_attempts', $attempts);

        if ($attempts >= 3) {
            $penalty = $this->penaltySeconds($attempts);
            $lockUntil = now()->addSeconds($penalty)->timestamp;

            Cache::put($this->lockKey($email), $lockUntil, $penalty);
            $this->addToRegistry($email, $lockUntil, $attempts);

            session()->flash('lock_until', $lockUntil);
            session()->flash('lock_seconds', $penalty);
        }
    }

    private function clearAttempts(string $email): void
    {
        Cache::forget($this->attemptsKey($email));
        Cache::forget($this->lockKey($email));
        $this->removeFromRegistry($email);
    }

    private function addToRegistry(string $email, int $lockUntil, int $attempts): void
    {
        $registry = Cache::get('login_blocked_registry', []);
        $registry[$email] = [
            'lock_until' => $lockUntil,
            'attempts' => $attempts,
            'ip' => $this->ip(),
        ];
        Cache::put('login_blocked_registry', $registry, now()->addDay());
    }

    private function removeFromRegistry(string $email): void
    {
        $registry = Cache::get('login_blocked_registry', []);
        unset($registry[$email]);
        if (empty($registry)) {
            Cache::forget('login_blocked_registry');
        } else {
            Cache::put('login_blocked_registry', $registry, now()->addDay());
        }
    }

    private function penaltySeconds(int $attempts): int
    {
        return match (true) {
            $attempts >= 8 => 600,
            $attempts >= 7 => 300,
            $attempts >= 6 => 120,
            $attempts >= 5 => 90,
            $attempts >= 4 => 60,
            default => 30,
        };
    }

    private function attemptsKey(string $email): string
    {
        return 'login_fails:'.$email;
    }

    private function lockKey(string $email): string
    {
        return 'login_locked:'.$email;
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}

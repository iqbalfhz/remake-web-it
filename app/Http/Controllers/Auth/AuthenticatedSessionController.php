<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $email = Str::lower($request->string('email'));

        try {
            $request->authenticate();
        } catch (ValidationException $e) {
            $user = User::where('email', $email)->first();
            $message = collect($e->errors())->flatten()->first() ?? 'Login gagal';

            activity('auth')
                ->causedBy($user)
                ->withProperties([
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                    'email' => $email,
                    'reason' => $message,
                ])
                ->event('failed')
                ->log('Login Gagal');

            throw $e;
        }

        $request->session()->regenerate();

        activity('auth')
            ->causedBy($request->user())
            ->withProperties(['ip' => $request->ip(), 'user_agent' => $request->userAgent()])
            ->log('Login');

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = $request->user();

        activity('auth')
            ->causedBy($user)
            ->withProperties(['ip' => $request->ip()])
            ->log('Logout');

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

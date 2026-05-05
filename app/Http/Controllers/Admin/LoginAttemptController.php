<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class LoginAttemptController extends Controller
{
    public function index(): View
    {
        $this->authorize('login-attempts.view');

        $registry = Cache::get('login_blocked_registry', []);
        $now = now()->timestamp;

        $blockedUsers = collect($registry)
            ->map(fn ($data, $email) => [
                'email' => $email,
                'lock_until' => $data['lock_until'],
                'attempts' => $data['attempts'],
                'ip' => $data['ip'] ?? '-',
                'remaining' => max(0, $data['lock_until'] - $now),
            ])
            ->filter(fn ($u) => $u['remaining'] > 0)
            ->sortByDesc('lock_until')
            ->values();

        return view('admin.login-attempts.index', compact('blockedUsers'));
    }

    public function unblock(Request $request): RedirectResponse
    {
        $request->validate(['email' => ['required', 'email']]);

        $email = strtolower($request->string('email')->toString());

        Cache::forget('login_locked:'.$email);
        Cache::forget('login_fails:'.$email);

        // Hapus dari registry
        $registry = Cache::get('login_blocked_registry', []);
        unset($registry[$email]);
        if (empty($registry)) {
            Cache::forget('login_blocked_registry');
        } else {
            Cache::put('login_blocked_registry', $registry, now()->addDay());
        }

        return back()->with('success', 'User '.e($email).' berhasil di-unblock.');
    }
}

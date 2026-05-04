@extends('admin.layouts.app')

@section('title', 'Blokir Login')

@section('content')

    @if (session('success') || session('error'))
        <div x-data="{ show: true }" x-show="show" x-cloak x-init="setTimeout(() => show = false, 5000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4"
            x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-4"
            style="position:fixed;top:24px;right:24px;z-index:250;max-width:380px;width:100%;"
            class="flex items-center gap-3 pl-4 pr-3 py-3.5 rounded-xl border shadow-xl overflow-hidden {{ session('error') ? 'bg-white border-red-200' : 'bg-white border-emerald-200' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 {{ session('error') ? 'bg-red-500' : 'bg-emerald-500' }}"></span>
            @if (session('error'))
                <svg class="w-5 h-5 shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @else
                <svg class="w-5 h-5 shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @endif
            <p class="text-sm font-medium flex-1 {{ session('error') ? 'text-red-700' : 'text-emerald-700' }}">
                {{ session('error') ?? session('success') }}</p>
            <button @click="show = false"
                class="shrink-0 rounded-lg p-1 transition-colors {{ session('error') ? 'text-red-400 hover:text-red-600 hover:bg-red-100' : 'text-emerald-400 hover:text-emerald-600 hover:bg-emerald-100' }}">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <div class="space-y-4">

        {{-- Header --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-red-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-semibold text-slate-800">Blokir Login</h2>
                    <p class="text-xs text-slate-400">
                        {{ $blockedUsers->count() }} pengguna sedang diblokir sementara
                    </p>
                </div>
            </div>
            <form method="GET" action="{{ route('admin.login-attempts.index') }}">
                <button type="submit"
                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-medium bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Refresh
                </button>
            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            @if ($blockedUsers->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 text-slate-400">
                    <svg class="w-12 h-12 mb-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <p class="text-sm font-medium text-slate-500">Tidak ada pengguna yang diblokir</p>
                    <p class="text-xs text-slate-400 mt-1">Semua akun sedang dalam keadaan normal</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-slate-100 bg-slate-50">
                                <th
                                    class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Email</th>
                                <th
                                    class="text-center px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Percobaan</th>
                                <th
                                    class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    IP Address</th>
                                <th
                                    class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Sisa Waktu</th>
                                <th
                                    class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Diblokir Hingga</th>
                                <th
                                    class="text-right px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($blockedUsers as $user)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-7 h-7 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                                                <svg class="w-3.5 h-3.5 text-red-500" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                            </div>
                                            <span class="font-medium text-slate-700">{{ $user['email'] }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <span
                                            class="inline-flex items-center justify-center w-7 h-7 rounded-full text-xs font-bold
                                            {{ $user['attempts'] >= 7 ? 'bg-red-100 text-red-700' : ($user['attempts'] >= 5 ? 'bg-orange-100 text-orange-700' : 'bg-yellow-100 text-yellow-700') }}">
                                            {{ $user['attempts'] }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <span
                                            class="font-mono text-xs text-slate-500 bg-slate-100 px-2 py-1 rounded">{{ $user['ip'] }}</span>
                                    </td>
                                    <td class="px-4 py-4" x-data="{
                                        remaining: {{ $user['remaining'] }},
                                        timer: null,
                                        init() { this.timer = setInterval(() => { if (this.remaining > 0) { this.remaining--; } else { clearInterval(this.timer); } }, 1000); }
                                    }">
                                        <span class="inline-flex items-center gap-1 text-xs font-medium text-red-600">
                                            <svg class="w-3.5 h-3.5 shrink-0" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span
                                                x-text="remaining > 0 ? (remaining >= 60 ? Math.floor(remaining/60)+'m '+( remaining%60)+'s' : remaining+'s') : 'Selesai'"></span>
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 text-xs text-slate-500">
                                        {{ \Carbon\Carbon::createFromTimestamp($user['lock_until'])->setTimezone(config('app.timezone'))->format('d M Y, H:i:s') }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <form method="POST" action="{{ route('admin.login-attempts.unblock') }}"
                                            onsubmit="return confirm('Unblock {{ $user['email'] }}?')">
                                            @csrf
                                            <input type="hidden" name="email" value="{{ $user['email'] }}">
                                            <button type="submit"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200 hover:bg-emerald-100 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                                </svg>
                                                Unblock
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>

@endsection

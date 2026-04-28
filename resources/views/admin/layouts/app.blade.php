<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - @yield('title', 'Dashboard') | IT Tangcity</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased">
    <div class="min-h-screen flex">

        {{-- Sidebar --}}
        <aside class="w-64 bg-gray-900 text-white flex flex-col shrink-0">
            <div class="h-16 flex items-center px-6 border-b border-white/10">
                <span class="text-lg font-bold tracking-tight text-white">IT Tangcity</span>
                <span class="ml-2 text-xs text-cyan-400 font-semibold uppercase">Admin</span>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1">
                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('admin.dashboard') ? 'bg-cyan-600 text-white' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Konten</p>
                </div>

                {{-- Artikel --}}
                <a href="{{ route('admin.artikel.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('admin.artikel.*') ? 'bg-cyan-600 text-white' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    Artikel
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Komunikasi</p>
                </div>

                {{-- Pesan Masuk --}}
                @php $unreadContactsCount = isset($unreadContacts) ? $unreadContacts->count() : \App\Models\Contact::where('is_read', false)->count(); @endphp
                <a href="{{ route('admin.contacts.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('admin.contacts.*') ? 'bg-cyan-600 text-white' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Pesan Masuk
                    @if ($unreadContactsCount > 0)
                        <span
                            class="ml-auto inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full">
                            {{ $unreadContactsCount }}
                        </span>
                    @endif
                </a>

                {{-- Mailing List --}}
                <a href="{{ route('admin.mailing-list.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('admin.mailing-list.*') ? 'bg-cyan-600 text-white' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Mailing List
                </a>

                {{-- Email Staff --}}
                <a href="{{ route('admin.staff-email.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('admin.staff-email.*') ? 'bg-cyan-600 text-white' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                    </svg>
                    Email Staff
                </a>

                {{-- Email Workspace --}}
                <a href="{{ route('admin.workspace-email') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('admin.workspace-email') ? 'bg-cyan-600 text-white' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                        <path
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                        <path
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                        <path
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                    </svg>
                    Email Workspace
                </a>

                <div class="pt-4 pb-2">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Sistem</p>
                </div>

                {{-- Pengguna --}}
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('admin.users.*') ? 'bg-cyan-600 text-white' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Pengguna
                    @php $pendingCount = \App\Models\User::where('is_approved', false)->where('is_admin', false)->count(); @endphp
                    @if ($pendingCount > 0)
                        <span
                            class="ml-auto inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full">
                            {{ $pendingCount }}
                        </span>
                    @endif
                </a>

                {{-- Roles --}}
                <a href="{{ route('admin.roles.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('admin.roles.*') ? 'bg-cyan-600 text-white' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    Role
                </a>

                {{-- Permissions --}}
                <a href="{{ route('admin.permissions.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors
                          {{ request()->routeIs('admin.permissions.*') ? 'bg-cyan-600 text-white' : 'text-gray-300 hover:bg-white/10 hover:text-white' }}">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                    Permission
                </a>
            </nav>
            <div class="px-4 py-4 border-t border-white/10">
                <div class="flex items-center gap-3 px-3 py-2">
                    <div class="w-8 h-8 rounded-full bg-cyan-600 flex items-center justify-center text-sm font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-2">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-gray-400 hover:bg-white/10 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-w-0">
            {{-- Top bar --}}
            @php
                $pendingUsers = \App\Models\User::where('is_approved', false)
                    ->where('is_admin', false)
                    ->latest()
                    ->get();
                // Use controller-passed $unreadContacts (pre-mark snapshot) if available
                if (!isset($unreadContacts)) {
                    $unreadContacts = \App\Models\Contact::where('is_read', false)->latest()->get();
                }
                $totalNotifications = $pendingUsers->count() + $unreadContacts->count();
            @endphp
            <header
                class="h-16 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between px-6">
                <h1 class="text-lg font-semibold text-gray-800 dark:text-white">@yield('title', 'Dashboard')</h1>

                {{-- Notification Bell --}}
                <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                    <button @click="open = !open"
                        class="relative p-2 rounded-lg text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        @if ($totalNotifications > 0)
                            <span
                                class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white dark:ring-gray-800"></span>
                        @endif
                    </button>

                    {{-- Dropdown --}}
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-xl shadow-lg ring-1 ring-black/10 dark:ring-white/10 z-50 overflow-hidden">

                        <div
                            class="flex items-center justify-between px-4 py-3 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-sm font-semibold text-gray-800 dark:text-white">Notifikasi</span>
                            @if ($totalNotifications > 0)
                                <span class="text-xs font-bold text-white bg-red-500 px-2 py-0.5 rounded-full">
                                    {{ $totalNotifications }} baru
                                </span>
                            @endif
                        </div>

                        <div class="max-h-80 overflow-y-auto">
                            {{-- Unread Messages Section --}}
                            @if ($unreadContacts->isNotEmpty())
                                <div
                                    class="px-4 py-2 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-100 dark:border-gray-700">
                                    <p
                                        class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Pesan Masuk</p>
                                </div>
                                @foreach ($unreadContacts as $contact)
                                    <a href="{{ route('admin.contacts.index') }}" @click="open = false"
                                        class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors border-b border-gray-50 dark:border-gray-700/50 last:border-0">
                                        <div
                                            class="w-9 h-9 rounded-full bg-cyan-100 dark:bg-cyan-900/40 flex items-center justify-center shrink-0 mt-0.5">
                                            <span class="text-sm font-semibold text-cyan-700 dark:text-cyan-400">
                                                {{ strtoupper(substr($contact->name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-800 dark:text-white truncate">
                                                {{ $contact->name }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                                {{ Str::limit($contact->message, 50) }}</p>
                                            <p class="text-xs text-cyan-600 dark:text-cyan-400 mt-0.5">Pesan baru
                                                &middot; {{ $contact->created_at->diffForHumans() }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            @endif

                            {{-- Pending Users Section --}}
                            @if ($pendingUsers->isNotEmpty())
                                <div
                                    class="px-4 py-2 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-100 dark:border-gray-700">
                                    <p
                                        class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Pendaftaran</p>
                                </div>
                                @foreach ($pendingUsers as $pendingUser)
                                    <a href="{{ route('admin.users.index') }}" @click="open = false"
                                        class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors border-b border-gray-50 dark:border-gray-700/50 last:border-0">
                                        <div
                                            class="w-9 h-9 rounded-full bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center shrink-0 mt-0.5">
                                            <span class="text-sm font-semibold text-amber-700 dark:text-amber-400">
                                                {{ strtoupper(substr($pendingUser->name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-800 dark:text-white truncate">
                                                {{ $pendingUser->name }}</p>
                                            <p class="text-xs text-gray-400 truncate">{{ $pendingUser->email }}</p>
                                            <p class="text-xs text-amber-600 dark:text-amber-400 mt-0.5">Menunggu
                                                persetujuan &middot; {{ $pendingUser->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </a>
                                @endforeach
                            @endif

                            {{-- Empty state --}}
                            @if ($totalNotifications === 0)
                                <div class="px-4 py-8 text-center">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-gray-300 dark:text-gray-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-sm text-gray-400">Tidak ada notifikasi baru</p>
                                </div>
                            @endif
                        </div>

                        @if ($totalNotifications > 0)
                            <div class="px-4 py-3 border-t border-gray-100 dark:border-gray-700 flex gap-3">
                                @if ($unreadContacts->isNotEmpty())
                                    <a href="{{ route('admin.contacts.index') }}" @click="open = false"
                                        class="flex-1 text-center text-xs font-medium text-cyan-600 dark:text-cyan-400 hover:underline">
                                        Lihat pesan &rarr;
                                    </a>
                                @endif
                                @if ($pendingUsers->isNotEmpty())
                                    <a href="{{ route('admin.users.index') }}" @click="open = false"
                                        class="flex-1 text-center text-xs font-medium text-amber-600 dark:text-amber-400 hover:underline">
                                        Lihat pengguna &rarr;
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </header>

            {{-- Page content --}}
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Global Confirm Modal --}}
    <div x-data="{ show: false, title: '', message: '', type: 'danger', pendingForm: null }"
        @open-confirm.window="show = true; title = $event.detail.title; message = $event.detail.message; type = $event.detail.type ?? 'danger'; pendingForm = $event.detail.form"
        x-show="show" x-cloak class="fixed inset-0 z-[200] flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="show = false"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-sm p-6"
            x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
            <div class="flex items-start gap-4 mb-5">
                <div :class="{
                    'bg-red-100 dark:bg-red-900/40': type === 'danger',
                    'bg-amber-100 dark:bg-amber-900/40': type === 'warning',
                    'bg-green-100 dark:bg-green-900/40': type === 'success',
                }"
                    class="w-11 h-11 rounded-full flex items-center justify-center shrink-0">
                    <svg x-show="type === 'danger'" class="w-5 h-5 text-red-600 dark:text-red-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <svg x-show="type === 'warning'" class="w-5 h-5 text-amber-600 dark:text-amber-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <svg x-show="type === 'success'" class="w-5 h-5 text-green-600 dark:text-green-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white" x-text="title"></h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1" x-text="message"></p>
                </div>
            </div>
            <div class="flex items-center justify-end gap-3">
                <button @click="show = false" type="button"
                    class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors">
                    Batal
                </button>
                <button @click="pendingForm.submit(); show = false" type="button"
                    :class="{
                        'bg-red-600 hover:bg-red-700': type === 'danger',
                        'bg-amber-500 hover:bg-amber-600': type === 'warning',
                        'bg-green-600 hover:bg-green-700': type === 'success',
                    }"
                    class="px-4 py-2 text-sm font-semibold text-white rounded-lg transition-colors">
                    Konfirmasi
                </button>
            </div>
        </div>
    </div>
</body>

</html>

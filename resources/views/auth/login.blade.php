<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | IT Tangcity</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-950">

    <div class="min-h-screen flex" x-data="{ showPassword: false }">

        {{-- Left Panel — Branding --}}
        <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden flex-col items-center justify-center p-12"
            style="background-color: #0f172a;">

            {{-- Gradient orbs --}}
            <div class="absolute -top-32 -left-32 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl pointer-events-none">
            </div>
            <div
                class="absolute -bottom-32 -right-32 w-96 h-96 bg-cyan-700/20 rounded-full blur-3xl pointer-events-none">
            </div>
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-cyan-600/5 rounded-full blur-3xl pointer-events-none">
            </div>

            {{-- Grid pattern overlay --}}
            <div class="absolute inset-0 opacity-[0.03]"
                style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(to right, #fff 1px, transparent 1px); background-size: 40px 40px;">
            </div>

            {{-- Content --}}
            <div class="relative z-10 text-center">
                {{-- Logo / Icon --}}
                <div class="relative inline-flex mb-8">
                    <div class="absolute inset-0 rounded-2xl bg-cyan-400/30 blur-xl"></div>
                    <div
                        class="relative inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-cyan-500 ring-2 ring-cyan-400/60 shadow-lg shadow-cyan-500/40">
                        <svg class="w-10 h-10 text-white drop-shadow" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18" />
                        </svg>
                    </div>
                </div>

                <h1 class="text-4xl font-bold tracking-tight mb-2" style="color: #ffffff;">IT Tangcity</h1>
                <p class="font-semibold text-sm uppercase tracking-widest mb-6" style="color: #22d3ee;">Admin Panel</p>

                <p class="text-sm leading-relaxed max-w-xs mx-auto" style="color: #94a3b8;">
                    Kelola konten, email, dan komunikasi departemen IT Tangcity dari satu tempat.
                </p>

                {{-- Decorative cards --}}
                <div class="mt-12 flex flex-col gap-3 max-w-xs mx-auto text-left">
                    @foreach ([['Manajemen Artikel & Konten', 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'], ['Email Staff & Workspace', 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'], ['Pesan & Mailing List', 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z']] as [$label, $icon])
                        <div class="flex items-center gap-3 px-4 py-3 rounded-xl"
                            style="background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15);">
                            <div class="shrink-0 w-9 h-9 rounded-lg flex items-center justify-center"
                                style="background-color: #0891b2;">
                                <svg class="w-5 h-5" style="color: #ffffff;" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $icon }}" />
                                </svg>
                            </div>
                            <span class="text-sm font-medium" style="color: #e2e8f0;">{{ $label }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Right Panel — Form --}}
        <div class="flex-1 flex items-center justify-center p-6 bg-white">
            <div class="w-full max-w-md">

                {{-- Mobile logo --}}
                <div class="lg:hidden text-center mb-8">
                    <span class="text-2xl font-bold text-gray-900">IT Tangcity</span>
                    <span class="block text-xs text-cyan-600 font-semibold uppercase tracking-widest mt-1">Admin
                        Panel</span>
                </div>

                <h2 class="text-2xl font-bold text-gray-900 mb-1">Selamat datang kembali</h2>
                <p class="text-sm text-gray-500 mb-8">Masuk untuk mengakses panel admin.</p>

                {{-- Session Status --}}
                @if (session('status'))
                    <div class="mb-5 px-4 py-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl">
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Validation errors --}}
                @if ($errors->any())
                    <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 text-red-700 text-sm rounded-xl">
                        <ul class="space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </span>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autofocus autocomplete="username"
                                class="w-full pl-10 pr-4 py-2.5 text-sm text-gray-900 bg-gray-50 border rounded-xl transition-all duration-200
                                   focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:bg-white
                                   {{ $errors->get('email') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
                                placeholder="email@tangcity.com">
                        </div>
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-sm font-medium text-gray-700">
                                Password
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                    class="text-xs text-cyan-600 hover:text-cyan-700 font-medium transition-colors">
                                    Lupa password?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </span>
                            <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required
                                autocomplete="current-password"
                                class="w-full pl-10 pr-10 py-2.5 text-sm text-gray-900 bg-gray-50 border rounded-xl transition-all duration-200
                                   focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 focus:bg-white
                                   {{ $errors->get('password') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
                                placeholder="••••••••">
                            <button type="button" @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-gray-600 transition-colors">
                                <svg x-show="!showPassword" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg x-show="showPassword" x-cloak class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center gap-2">
                        <input id="remember_me" type="checkbox" name="remember"
                            class="w-4 h-4 rounded border-gray-300 text-cyan-600 focus:ring-cyan-500 cursor-pointer">
                        <label for="remember_me" class="text-sm text-gray-600 cursor-pointer select-none">
                            Ingat saya selama 30 hari
                        </label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-cyan-600 hover:bg-cyan-700 active:bg-cyan-800
                           text-white text-sm font-semibold rounded-xl transition-all duration-200 shadow-sm hover:shadow-md hover:shadow-cyan-500/25 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Masuk ke Panel Admin
                    </button>
                </form>

                <p class="mt-8 text-center text-xs text-gray-400">
                    &copy; {{ date('Y') }} IT Tangcity. Akses terbatas untuk admin.
                </p>
            </div>
        </div>

    </div>

</body>

</html>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="IT Tangcity - Teknologi & Informasi Tangcity Superblock">
    <title>@yield('title', 'IT Tangcity')</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    {{-- AOS --}}
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css">

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="bg-gray-950 text-gray-100 font-jakarta antialiased" x-data="{ mobileMenuOpen: false }">

    {{-- Navbar --}}
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300" x-data="{ scrolled: false }"
        x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
        :class="scrolled ? 'bg-gray-950/90 backdrop-blur-lg shadow-lg shadow-black/20 border-b border-white/5' :
            'bg-transparent'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-20">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div
                        class="w-9 h-9 rounded-xl bg-linear-to-br from-blue-500 to-cyan-400 flex items-center justify-center shadow-lg shadow-blue-500/30 group-hover:shadow-blue-500/50 transition-shadow">
                        <i class="fa-solid fa-microchip text-white text-sm"></i>
                    </div>
                    <span class="text-lg font-bold text-white tracking-tight">
                        IT <span
                            class="text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-400">Tangcity</span>
                    </span>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('home') }}"
                        class="px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-white/5 transition-all">Home</a>
                    <a href="{{ route('artikel.index') }}"
                        class="px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-white/5 transition-all">Artikel</a>

                    {{-- Daftar Email Dropdown --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button
                            class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-white/5 transition-all"
                            :class="open ? 'text-white bg-white/5' : ''">
                            Daftar Email
                            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"
                                :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute top-full left-0 mt-1 w-52 rounded-xl bg-gray-900 border border-white/10 shadow-xl shadow-black/40 overflow-hidden">
                            <div class="p-1.5 space-y-0.5">
                                <a href="{{ route('email.mailing-list') }}"
                                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-all group">
                                    <i
                                        class="fa-solid fa-list text-xs text-cyan-500/70 group-hover:text-cyan-400 transition-colors w-4"></i>
                                    Mailing List
                                </a>
                                <a href="{{ route('email.seluruh-staff') }}"
                                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-all group">
                                    <i
                                        class="fa-solid fa-users text-xs text-cyan-500/70 group-hover:text-cyan-400 transition-colors w-4"></i>
                                    Email Seluruh Staff
                                </a>
                                <a href="{{ route('email.workspace') }}"
                                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-all group">
                                    <i
                                        class="fa-solid fa-desktop text-xs text-cyan-500/70 group-hover:text-cyan-400 transition-colors w-4"></i>
                                    Email Workspace
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Aplikasi Dropdown --}}
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button
                            class="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-white/5 transition-all"
                            :class="open ? 'text-white bg-white/5' : ''">
                            Aplikasi
                            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"
                                :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute top-full left-0 mt-1 w-56 rounded-xl bg-gray-900 border border-white/10 shadow-xl shadow-black/40 overflow-hidden">
                            <div class="p-1.5 space-y-0.5">
                                <a href="http://192.168.1.222/login" target="_blank"
                                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-all group">
                                    <i
                                        class="fa-solid fa-server text-xs text-cyan-500/70 group-hover:text-cyan-400 transition-colors w-4"></i>
                                    Asset Tangcity
                                </a>
                                <a href="#"
                                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-all group">
                                    <i
                                        class="fa-solid fa-box-archive text-xs text-cyan-500/70 group-hover:text-cyan-400 transition-colors w-4"></i>
                                    e-Arsip
                                </a>
                                <a href="#"
                                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-all group">
                                    <i
                                        class="fa-solid fa-comment-dots text-xs text-cyan-500/70 group-hover:text-cyan-400 transition-colors w-4"></i>
                                    Messanger
                                </a>
                                <a href="https://meet.tangcity.com/" target="_blank"
                                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-all group">
                                    <i
                                        class="fa-solid fa-calendar-days text-xs text-cyan-500/70 group-hover:text-cyan-400 transition-colors w-4"></i>
                                    Meeting Room
                                </a>
                                <a href="https://penomoran.tangcity.com/" target="_blank"
                                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg text-sm text-gray-300 hover:text-white hover:bg-white/5 transition-all group">
                                    <i
                                        class="fa-solid fa-file-circle-check text-xs text-cyan-500/70 group-hover:text-cyan-400 transition-colors w-4"></i>
                                    Penomoran Dokumen
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('home') }}#about"
                        class="px-3 py-2 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-white/5 transition-all">About</a>
                    <a href="{{ route('home') }}#contact"
                        class="ml-3 px-5 py-2 rounded-xl bg-linear-to-r from-blue-600 to-cyan-500 text-white text-sm font-semibold hover:from-blue-500 hover:to-cyan-400 transition-all shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40">
                        Kontak
                    </a>
                </div>

                {{-- Mobile Menu Button --}}
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="md:hidden w-10 h-10 rounded-lg flex items-center justify-center text-gray-300 hover:text-white hover:bg-white/10 transition-all">
                    <i class="fa-solid" :class="mobileMenuOpen ? 'fa-xmark text-lg' : 'fa-bars'"></i>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden bg-gray-900/95 backdrop-blur-xl border-b border-white/5">
            <div class="px-4 pt-2 pb-4 space-y-1">
                <a href="{{ route('home') }}" @click="mobileMenuOpen = false"
                    class="block px-4 py-3 rounded-lg text-gray-300 hover:text-white hover:bg-white/5 transition-all text-sm font-medium">Home</a>
                <a href="{{ route('artikel.index') }}" @click="mobileMenuOpen = false"
                    class="block px-4 py-3 rounded-lg text-gray-300 hover:text-white hover:bg-white/5 transition-all text-sm font-medium">Artikel</a>

                {{-- Mobile: Daftar Email --}}
                <div x-data="{ emailOpen: false }">
                    <button @click="emailOpen = !emailOpen"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-lg text-gray-300 hover:text-white hover:bg-white/5 transition-all text-sm font-medium">
                        Daftar Email
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"
                            :class="emailOpen ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="emailOpen" x-transition class="pl-4 space-y-1 mt-1">
                        <a href="{{ route('email.mailing-list') }}" @click="mobileMenuOpen = false"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                            <i class="fa-solid fa-list text-xs text-cyan-500/70 w-4"></i>Mailing List
                        </a>
                        <a href="{{ route('email.seluruh-staff') }}" @click="mobileMenuOpen = false"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                            <i class="fa-solid fa-users text-xs text-cyan-500/70 w-4"></i>Email Seluruh Staff
                        </a>
                        <a href="{{ route('email.workspace') }}" @click="mobileMenuOpen = false"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                            <i class="fa-solid fa-desktop text-xs text-cyan-500/70 w-4"></i>Email Workspace
                        </a>
                    </div>
                </div>

                {{-- Mobile: Aplikasi --}}
                <div x-data="{ appsOpen: false }">
                    <button @click="appsOpen = !appsOpen"
                        class="w-full flex items-center justify-between px-4 py-3 rounded-lg text-gray-300 hover:text-white hover:bg-white/5 transition-all text-sm font-medium">
                        Aplikasi
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"
                            :class="appsOpen ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="appsOpen" x-transition class="pl-4 space-y-1 mt-1">
                        <a href="http://192.168.1.222/login" target="_blank" @click="mobileMenuOpen = false"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                            <i class="fa-solid fa-server text-xs text-cyan-500/70 w-4"></i>Asset Tangcity
                        </a>
                        <a href="#" @click="mobileMenuOpen = false"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                            <i class="fa-solid fa-box-archive text-xs text-cyan-500/70 w-4"></i>e-Arsip
                        </a>
                        <a href="#" @click="mobileMenuOpen = false"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                            <i class="fa-solid fa-comment-dots text-xs text-cyan-500/70 w-4"></i>Messanger
                        </a>
                        <a href="https://meet.tangcity.com/" target="_blank" @click="mobileMenuOpen = false"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                            <i class="fa-solid fa-calendar-days text-xs text-cyan-500/70 w-4"></i>Meeting Room
                        </a>
                        <a href="https://penomoran.tangcity.com/" target="_blank" @click="mobileMenuOpen = false"
                            class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                            <i class="fa-solid fa-file-circle-check text-xs text-cyan-500/70 w-4"></i>Penomoran Dokumen
                        </a>
                    </div>
                </div>

                <a href="{{ route('home') }}#about" @click="mobileMenuOpen = false"
                    class="block px-4 py-3 rounded-lg text-gray-300 hover:text-white hover:bg-white/5 transition-all text-sm font-medium">About</a>
                <div class="pt-2">
                    <a href="{{ route('home') }}#contact" @click="mobileMenuOpen = false"
                        class="block px-4 py-3 rounded-xl bg-linear-to-r from-blue-600 to-cyan-500 text-white text-sm font-semibold text-center">
                        Kontak
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                {{-- Brand --}}
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-9 h-9 rounded-xl bg-linear-to-br from-blue-500 to-cyan-400 flex items-center justify-center">
                            <i class="fa-solid fa-microchip text-white text-sm"></i>
                        </div>
                        <span class="text-lg font-bold text-white">IT <span
                                class="text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-400">Tangcity</span></span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Mengelola teknologi informasi dan sistem IT di Tangcity Superblock untuk mendukung operasional
                        perusahaan.
                    </p>
                </div>

                {{-- Quick Links --}}
                <div class="space-y-4">
                    <h3 class="text-white font-semibold text-sm uppercase tracking-wider">Navigasi</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}#about"
                                class="text-gray-400 hover:text-cyan-400 text-sm transition-colors flex items-center gap-2"><i
                                    class="fa-solid fa-chevron-right text-xs text-cyan-500/50"></i>About Us</a></li>
                        <li><a href="{{ route('home') }}#assets"
                                class="text-gray-400 hover:text-cyan-400 text-sm transition-colors flex items-center gap-2"><i
                                    class="fa-solid fa-chevron-right text-xs text-cyan-500/50"></i>Asset Tangcity</a>
                        </li>
                        <li><a href="{{ route('artikel.index') }}"
                                class="text-gray-400 hover:text-cyan-400 text-sm transition-colors flex items-center gap-2"><i
                                    class="fa-solid fa-chevron-right text-xs text-cyan-500/50"></i>Artikel</a></li>
                        <li><a href="{{ route('home') }}#contact"
                                class="text-gray-400 hover:text-cyan-400 text-sm transition-colors flex items-center gap-2"><i
                                    class="fa-solid fa-chevron-right text-xs text-cyan-500/50"></i>Kontak</a></li>
                    </ul>
                </div>

                {{-- Contact Info --}}
                <div class="space-y-4">
                    <h3 class="text-white font-semibold text-sm uppercase tracking-wider">Kontak</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3 text-sm text-gray-400">
                            <i class="fa-solid fa-location-dot text-cyan-500 mt-0.5 shrink-0"></i>
                            <span>Tangcity Superblock, Jl. Benteng Betawi, Tangerang</span>
                        </li>
                        <li class="flex items-center gap-3 text-sm text-gray-400">
                            <i class="fa-solid fa-envelope text-cyan-500 shrink-0"></i>
                            <span>it@tangcity.cloud</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div
                class="mt-10 pt-8 border-t border-white/5 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-gray-500 text-sm">© {{ date('Y') }} IT Tangcity. All Rights Reserved.</p>
                <p class="text-gray-600 text-xs">"Let's go invent tomorrow instead of worrying about what happened
                    yesterday."</p>
            </div>
        </div>
    </footer>

    {{-- AOS --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 700,
            easing: 'ease-out-cubic',
            once: true,
            offset: 60,
        });
    </script>

    @stack('scripts')
</body>

</html>

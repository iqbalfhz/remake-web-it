@extends('layouts.app')

@section('title', 'IT Tangcity - Teknologi & Informasi Tangcity Superblock')

@push('styles')
    <style>
        .hero-gradient {
            background: radial-gradient(ellipse 80% 80% at 50% -10%, rgba(59, 130, 246, 0.25) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 80% 50%, rgba(6, 182, 212, 0.1) 0%, transparent 50%),
                #030712;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }

        .glow-blue {
            box-shadow: 0 0 40px rgba(59, 130, 246, 0.15);
        }

        .glow-cyan {
            box-shadow: 0 0 40px rgba(6, 182, 212, 0.15);
        }

        .text-glow {
            text-shadow: 0 0 40px rgba(96, 165, 250, 0.4);
        }

        .grid-bg {
            background-image: linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        .service-card:hover .service-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .article-card:hover {
            transform: translateY(-4px);
        }
    </style>
@endpush

@section('content')

    {{-- ===== HERO SECTION ===== --}}
    <section class="hero-gradient grid-bg min-h-screen flex items-center relative overflow-hidden">

        {{-- Decorative blobs --}}
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-20 w-full">
            <div class="text-center max-w-4xl mx-auto">

                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full glass-card border border-blue-500/20 text-blue-400 text-xs font-semibold uppercase tracking-widest mb-8"
                    data-aos="fade-down">
                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                    Tangcity Superblock IT Division
                </div>

                {{-- Heading --}}
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-white leading-tight text-glow mb-6"
                    data-aos="fade-up" data-aos-delay="100">
                    Selamat Datang di<br>
                    <span class="text-transparent bg-clip-text bg-linear-to-r from-blue-400 via-cyan-400 to-blue-300">
                        Website IT Tangcity
                    </span>
                </h1>

                {{-- Subheading --}}
                <p class="text-lg sm:text-xl text-gray-400 leading-relaxed max-w-2xl mx-auto mb-10" data-aos="fade-up"
                    data-aos-delay="200">
                    Segala informasi terkait teknologi dan informasi yang ada di
                    <strong class="text-gray-200">Tangcity Superblock</strong> akan dibagikan di sini.
                </p>

                {{-- Buttons --}}
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4" data-aos="fade-up"
                    data-aos-delay="300">
                    <a href="#contact"
                        class="px-8 py-3.5 rounded-xl bg-linear-to-r from-blue-600 to-cyan-500 text-white font-semibold text-sm hover:from-blue-500 hover:to-cyan-400 transition-all shadow-xl shadow-blue-500/30 hover:shadow-blue-500/50 hover:-translate-y-0.5 transform duration-200">
                        <i class="fa-solid fa-paper-plane mr-2"></i>Contact Us
                    </a>
                    <a href="{{ route('artikel.index') }}"
                        class="px-8 py-3.5 rounded-xl glass-card text-gray-200 font-semibold text-sm hover:bg-white/10 transition-all hover:-translate-y-0.5 transform duration-200">
                        <i class="fa-solid fa-newspaper mr-2 text-cyan-400"></i>Baca Artikel
                    </a>
                </div>

                {{-- Stats --}}
                <div class="grid grid-cols-3 gap-6 max-w-lg mx-auto mt-20" data-aos="fade-up" data-aos-delay="400">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">500+</div>
                        <div class="text-xs text-gray-500 mt-1">Aset IT</div>
                    </div>
                    <div class="text-center border-x border-white/5">
                        <div class="text-2xl font-bold text-white">24/7</div>
                        <div class="text-xs text-gray-500 mt-1">Monitoring</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-white">99%</div>
                        <div class="text-xs text-gray-500 mt-1">Uptime</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Scroll indicator --}}
        <div
            class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-gray-600 animate-bounce">
            <span class="text-xs uppercase tracking-widest">Scroll</span>
            <i class="fa-solid fa-chevron-down text-xs"></i>
        </div>
    </section>

    {{-- ===== ABOUT SECTION ===== --}}
    <section id="about" class="py-24 bg-gray-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Section Header --}}
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-cyan-400 text-xs font-bold uppercase tracking-widest">Tentang Kami</span>
                <h2 class="text-4xl font-bold text-white mt-3">About <span
                        class="text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-400">Us</span></h2>
                <p class="text-gray-400 mt-4 max-w-xl mx-auto">Tim IT profesional yang mendukung operasional teknologi
                    informasi di Tangcity Superblock</p>
            </div>

            {{-- Services Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                @php
                    $services = [
                        [
                            'icon' => 'fa-shield-halved',
                            'color' => 'blue',
                            'title' => 'Standarisasi SI/TI',
                            'items' => [
                                'Hardware, Software, Jaringan',
                                'Preventive Maintenance',
                                'Monitoring & Backup',
                            ],
                        ],
                        [
                            'icon' => 'fa-screwdriver-wrench',
                            'color' => 'cyan',
                            'title' => 'Troubleshooting SI/TI',
                            'items' => ['Diagnosis Masalah', 'Penanganan Cepat', 'Laporan Insiden'],
                        ],
                        [
                            'icon' => 'fa-arrow-trend-up',
                            'color' => 'blue',
                            'title' => 'Improvement SI/TI',
                            'items' => ['Update & Upgrade', 'Creation', 'Corrective Action'],
                        ],
                        [
                            'icon' => 'fa-database',
                            'color' => 'cyan',
                            'title' => 'Pendataan Aset TI',
                            'items' => ['Inventarisasi Aset', 'Administratif', 'Update Berkelanjutan'],
                        ],
                        [
                            'icon' => 'fa-plug-circle-check',
                            'color' => 'blue',
                            'title' => 'Implementasi SI/TI',
                            'items' => ['Deployment Sistem', 'Konfigurasi Jaringan', 'Integrasi Aplikasi'],
                        ],
                        [
                            'icon' => 'fa-graduation-cap',
                            'color' => 'cyan',
                            'title' => 'Edukasi SI/TI',
                            'items' => ['Pelatihan User', 'Sosialisasi Sistem', 'Knowledge Sharing'],
                        ],
                    ];
                @endphp

                @foreach ($services as $index => $service)
                    <div class="service-card glass-card rounded-2xl p-6 transition-all duration-300 hover:border-blue-500/20 hover:glow-blue group"
                        data-aos="fade-up" data-aos-delay="{{ $index * 80 }}">
                        <div class="flex items-start gap-4">
                            <div
                                class="service-icon w-12 h-12 rounded-xl flex items-center justify-center shrink-0 transition-transform duration-300
                                {{ $service['color'] === 'blue' ? 'bg-blue-500/10 text-blue-400' : 'bg-cyan-500/10 text-cyan-400' }}">
                                <i class="fa-solid {{ $service['icon'] }} text-lg"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-white font-semibold mb-2 text-sm">{{ $service['title'] }}</h3>
                                <ul class="space-y-1">
                                    @foreach ($service['items'] as $item)
                                        <li class="text-gray-500 text-xs flex items-center gap-2">
                                            <span
                                                class="w-1 h-1 rounded-full {{ $service['color'] === 'blue' ? 'bg-blue-500' : 'bg-cyan-500' }} shrink-0"></span>
                                            {{ $item }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- CTA Banner --}}
            <div class="mt-10 glass-card rounded-2xl p-8 flex flex-col sm:flex-row items-center justify-between gap-6 border border-blue-500/10"
                data-aos="fade-up">
                <div>
                    <p class="text-gray-400 text-sm">Butuh perangkat pendukung pekerjaan?</p>
                    <h3 class="text-white font-bold text-lg mt-1">Mau pengajuan barang ke GA?</h3>
                </div>
                <a href="#contact"
                    class="shrink-0 px-6 py-3 rounded-xl bg-linear-to-r from-blue-600 to-cyan-500 text-white font-semibold text-sm hover:from-blue-500 hover:to-cyan-400 transition-all shadow-lg shadow-blue-500/25">
                    <i class="fa-solid fa-paper-plane mr-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    {{-- ===== ASSET SECTION ===== --}}
    <section id="assets" class="py-24 bg-gray-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-cyan-400 text-xs font-bold uppercase tracking-widest">Sistem Internal</span>
                <h2 class="text-4xl font-bold text-white mt-3">Asset <span
                        class="text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-400">Tangcity</span>
                </h2>
                <p class="text-gray-400 mt-4 max-w-xl mx-auto">Akses sistem dan layanan internal Tangcity Superblock</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-3xl mx-auto">

                {{-- Asset System --}}
                <div class="glass-card rounded-2xl p-8 text-center hover:border-blue-500/20 transition-all duration-300 hover:-translate-y-1 group"
                    data-aos="fade-right">
                    <div
                        class="w-16 h-16 rounded-2xl bg-linear-to-br from-blue-600 to-blue-400 flex items-center justify-center mx-auto mb-5 shadow-xl shadow-blue-500/30 group-hover:shadow-blue-500/50 transition-shadow">
                        <i class="fa-solid fa-server text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white font-bold text-lg mb-2">Asset Tangcity</h3>
                    <p class="text-gray-400 text-sm mb-6 leading-relaxed">Sistem manajemen aset IT internal. Monitor dan
                        kelola seluruh inventaris perangkat perusahaan.</p>
                    <a href="http://192.168.1.222/login" target="_blank"
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-500 transition-colors">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>Let's Go
                    </a>
                </div>

                {{-- Mailing List --}}
                <div class="glass-card rounded-2xl p-8 text-center hover:border-cyan-500/20 transition-all duration-300 hover:-translate-y-1 group"
                    data-aos="fade-left">
                    <div
                        class="w-16 h-16 rounded-2xl bg-linear-to-br from-cyan-600 to-cyan-400 flex items-center justify-center mx-auto mb-5 shadow-xl shadow-cyan-500/30 group-hover:shadow-cyan-500/50 transition-shadow">
                        <i class="fa-solid fa-envelope-open-text text-white text-2xl"></i>
                    </div>
                    <h3 class="text-white font-bold text-lg mb-2">Mailing List</h3>
                    <p class="text-gray-400 text-sm mb-6 leading-relaxed">Sudah tau belum kita ada mailing list? Atau ingin
                        tau email orang yang ada di Tangcity?</p>
                    <a href="https://www.tangcity.cloud/daftar-email/mailing-list/" target="_blank"
                        class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-cyan-600 text-white text-sm font-semibold hover:bg-cyan-500 transition-colors">
                        <i class="fa-solid fa-list-ul"></i>Mailing List
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== ARTICLES SECTION ===== --}}
    <section id="articles" class="py-24 bg-gray-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 mb-16"
                data-aos="fade-up">
                <div>
                    <span class="text-cyan-400 text-xs font-bold uppercase tracking-widest">Blog & Edukasi</span>
                    <h2 class="text-4xl font-bold text-white mt-3">Keep Learning <span
                            class="text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-400">Something
                            New</span></h2>
                </div>
                <a href="{{ route('artikel.index') }}"
                    class="shrink-0 text-sm text-cyan-400 hover:text-cyan-300 font-medium flex items-center gap-2 transition-colors">
                    Lihat semua <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>

            @if ($articles->isEmpty())
                <div class="text-center py-20 text-gray-600">
                    <i class="fa-solid fa-newspaper text-5xl mb-4 block opacity-30"></i>
                    <p class="text-lg">Belum ada artikel.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($articles as $index => $article)
                        <article
                            class="article-card glass-card rounded-2xl overflow-hidden transition-all duration-300 hover:border-blue-500/20 hover:glow-blue group"
                            data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">

                            {{-- Image --}}
                            <div class="relative overflow-hidden h-48 bg-linear-to-br from-blue-900/50 to-cyan-900/30">
                                @if ($article->image)
                                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fa-solid fa-newspaper text-5xl text-blue-500/20"></i>
                                    </div>
                                @endif
                                {{-- Category badge --}}
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="px-3 py-1 rounded-full bg-blue-600/80 backdrop-blur text-white text-xs font-semibold">
                                        {{ $article->category }}
                                    </span>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="p-6">
                                <div class="flex items-center gap-2 text-gray-500 text-xs mb-3">
                                    <i class="fa-regular fa-calendar"></i>
                                    <time>{{ $article->published_at->translatedFormat('d F Y') }}</time>
                                </div>
                                <h3
                                    class="text-white font-semibold text-base leading-snug mb-3 group-hover:text-cyan-400 transition-colors line-clamp-2">
                                    <a href="{{ route('artikel.show', $article->slug) }}">{{ $article->title }}</a>
                                </h3>
                                <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-5">{{ $article->excerpt }}
                                </p>
                                <a href="{{ route('artikel.show', $article->slug) }}"
                                    class="inline-flex items-center gap-2 text-cyan-400 text-xs font-semibold hover:gap-3 transition-all">
                                    Read more <i class="fa-solid fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ===== CONTACT SECTION ===== --}}
    <section id="contact" class="py-24 bg-gray-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="max-w-2xl mx-auto">
                <div class="text-center mb-12" data-aos="fade-up">
                    <span class="text-cyan-400 text-xs font-bold uppercase tracking-widest">Hubungi Kami</span>
                    <h2 class="text-4xl font-bold text-white mt-3">Educate <span
                            class="text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-400">Yourself</span>
                    </h2>
                    <p class="text-gray-400 mt-4 italic text-sm">"Let's go invent tomorrow instead of worrying about what
                        happened yesterday."</p>
                </div>

                {{-- Success Alert --}}
                @if (session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm flex items-center gap-3"
                        data-aos="fade-down">
                        <i class="fa-solid fa-circle-check text-lg shrink-0"></i>
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Contact Form --}}
                <div class="glass-card rounded-2xl p-8" data-aos="fade-up" data-aos-delay="100">
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nama</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 text-sm focus:outline-none focus:border-blue-500/50 focus:bg-white/8 transition-all"
                                placeholder="Nama lengkap Anda">
                            @error('name')
                                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 text-sm focus:outline-none focus:border-blue-500/50 focus:bg-white/8 transition-all"
                                placeholder="email@tangcity.cloud">
                            @error('email')
                                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-300 mb-2">Pesan</label>
                            <textarea id="message" name="message" rows="5" required
                                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 text-sm focus:outline-none focus:border-blue-500/50 focus:bg-white/8 transition-all resize-none"
                                placeholder="Tuliskan pesan Anda di sini...">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-400 text-xs mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full py-3.5 rounded-xl bg-linear-to-r from-blue-600 to-cyan-500 text-white font-semibold text-sm hover:from-blue-500 hover:to-cyan-400 transition-all shadow-xl shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-0.5 transform duration-200">
                            <i class="fa-solid fa-paper-plane mr-2"></i>Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

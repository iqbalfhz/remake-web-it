@extends('layouts.app')

@section('title', 'Artikel - IT Tangcity')

@section('content')

    {{-- Page Header --}}
    <section class="pt-32 pb-16 bg-gray-950 relative overflow-hidden">
        <div class="absolute inset-0 bg-linear-to-b from-blue-950/30 to-transparent pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center" data-aos="fade-up">
                <span class="text-cyan-400 text-xs font-bold uppercase tracking-widest">Blog & Edukasi</span>
                <h1 class="text-4xl sm:text-5xl font-bold text-white mt-3">
                    Keep Learning <span
                        class="text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-400">Something New</span>
                </h1>
                <p class="text-gray-400 mt-4 max-w-xl mx-auto">Kumpulan artikel, tips, dan informasi seputar teknologi
                    informasi dari tim IT Tangcity</p>
            </div>
        </div>
    </section>

    {{-- Filter & Search --}}
    <section class="bg-gray-950 pb-8 sticky top-16 md:top-20 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="GET" action="{{ route('artikel.index') }}" class="flex flex-col sm:flex-row gap-3">

                {{-- Search --}}
                <div class="relative flex-1">
                    <i
                        class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full pl-11 pr-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-gray-600 text-sm focus:outline-none focus:border-blue-500/50 transition-all"
                        placeholder="Cari artikel...">
                </div>

                {{-- Category Filter --}}
                <select name="category"
                    class="px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-300 text-sm focus:outline-none focus:border-blue-500/50 transition-all cursor-pointer min-w-[160px]">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>
                            {{ $cat }}</option>
                    @endforeach
                </select>

                <button type="submit"
                    class="px-6 py-3 rounded-xl bg-linear-to-r from-blue-600 to-cyan-500 text-white text-sm font-semibold hover:from-blue-500 hover:to-cyan-400 transition-all shrink-0">
                    <i class="fa-solid fa-filter mr-1.5"></i>Filter
                </button>

                @if (request()->hasAny(['search', 'category']))
                    <a href="{{ route('artikel.index') }}"
                        class="px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-gray-400 text-sm hover:bg-white/10 transition-all shrink-0 flex items-center gap-2">
                        <i class="fa-solid fa-xmark"></i> Reset
                    </a>
                @endif
            </form>
        </div>
    </section>

    {{-- Articles Grid --}}
    <section class="bg-gray-950 py-10 min-h-[50vh]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if ($articles->isEmpty())
                <div class="text-center py-20 text-gray-600" data-aos="fade-up">
                    <i class="fa-solid fa-newspaper text-6xl block mb-4 opacity-20"></i>
                    <h3 class="text-xl font-semibold text-gray-500 mb-2">Artikel tidak ditemukan</h3>
                    <p class="text-sm">Coba gunakan kata kunci yang berbeda</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    @foreach ($articles as $index => $article)
                        <article
                            class="glass-card rounded-2xl overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:border-blue-500/20 group"
                            style="background: rgba(255,255,255,0.03); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.06);"
                            data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 80 }}">

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
                                <h2
                                    class="text-white font-semibold text-base leading-snug mb-3 group-hover:text-cyan-400 transition-colors line-clamp-2">
                                    <a href="{{ route('artikel.show', $article->slug) }}">{{ $article->title }}</a>
                                </h2>
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

                {{-- Pagination --}}
                @if ($articles->hasPages())
                    <div class="flex justify-center" data-aos="fade-up">
                        {{ $articles->links('vendor.pagination.custom') }}
                    </div>
                @endif
            @endif

        </div>
    </section>

@endsection

@push('styles')
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.06);
        }
    </style>
@endpush

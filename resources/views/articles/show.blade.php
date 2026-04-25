@extends('layouts.app')

@section('title', $article->title . ' - IT Tangcity')

@section('content')

    {{-- Article Header --}}
    <section class="pt-32 pb-10 bg-gray-950 relative overflow-hidden">
        <div class="absolute inset-0 bg-linear-to-b from-blue-950/30 to-transparent pointer-events-none"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-xs text-gray-500 mb-8" data-aos="fade-down">
                <a href="{{ route('home') }}" class="hover:text-cyan-400 transition-colors">Home</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <a href="{{ route('artikel.index') }}" class="hover:text-cyan-400 transition-colors">Artikel</a>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span class="text-gray-400 truncate max-w-[200px]">{{ $article->title }}</span>
            </nav>

            {{-- Category + Date --}}
            <div class="flex items-center gap-3 mb-5" data-aos="fade-up" data-aos-delay="50">
                <span
                    class="px-3 py-1 rounded-full bg-blue-600/80 text-white text-xs font-semibold">{{ $article->category }}</span>
                <span class="text-gray-500 text-xs flex items-center gap-1.5">
                    <i class="fa-regular fa-calendar"></i>
                    {{ $article->published_at->translatedFormat('d F Y') }}
                </span>
            </div>

            {{-- Title --}}
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6" data-aos="fade-up"
                data-aos-delay="100">
                {{ $article->title }}
            </h1>

            {{-- Excerpt --}}
            <p class="text-gray-400 text-lg leading-relaxed" data-aos="fade-up" data-aos-delay="150">
                {{ $article->excerpt }}
            </p>
        </div>
    </section>

    {{-- Article Image --}}
    @if ($article->image)
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-12" data-aos="fade-up">
            <div class="rounded-2xl overflow-hidden" style="border: 1px solid rgba(255,255,255,0.06);">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                    class="w-full max-h-[480px] object-cover">
            </div>
        </div>
    @endif

    {{-- Article Content --}}
    <section class="pb-20 bg-gray-950">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12">

                {{-- Main Content --}}
                <article class="flex-1 min-w-0" data-aos="fade-up">
                    <div class="prose-article">
                        {!! nl2br(e($article->content)) !!}
                    </div>

                    {{-- Share / Back --}}
                    <div class="mt-12 pt-8 border-t border-white/5 flex items-center justify-between">
                        <a href="{{ route('artikel.index') }}"
                            class="inline-flex items-center gap-2 text-gray-400 hover:text-cyan-400 text-sm transition-colors">
                            <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Artikel
                        </a>
                        <div class="flex items-center gap-3 text-xs text-gray-500">
                            <span>Bagikan:</span>
                            <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . request()->url()) }}"
                                target="_blank" rel="noopener"
                                class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center hover:bg-green-600 text-gray-400 hover:text-white transition-all">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(request()->url()) }}"
                                target="_blank" rel="noopener"
                                class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center hover:bg-sky-600 text-gray-400 hover:text-white transition-all">
                                <i class="fa-brands fa-x-twitter"></i>
                            </a>
                        </div>
                    </div>
                </article>

                {{-- Sidebar: Related Articles --}}
                @if ($related->isNotEmpty())
                    <aside class="lg:w-72 shrink-0" data-aos="fade-left">
                        <h3 class="text-white font-semibold text-sm uppercase tracking-wider mb-5">Artikel Terkait</h3>
                        <div class="space-y-4">
                            @foreach ($related as $rel)
                                <a href="{{ route('artikel.show', $rel->slug) }}"
                                    class="flex gap-4 p-4 rounded-xl hover:bg-white/5 transition-all group"
                                    style="border: 1px solid rgba(255,255,255,0.05);">
                                    <div
                                        class="w-16 h-16 rounded-lg overflow-hidden shrink-0 bg-linear-to-br from-blue-900/50 to-cyan-900/30 flex items-center justify-center">
                                        @if ($rel->image)
                                            <img src="{{ asset('storage/' . $rel->image) }}" alt="{{ $rel->title }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <i class="fa-solid fa-newspaper text-blue-500/30"></i>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p
                                            class="text-white text-xs font-medium leading-snug line-clamp-2 group-hover:text-cyan-400 transition-colors">
                                            {{ $rel->title }}</p>
                                        <p class="text-gray-500 text-xs mt-1">
                                            {{ $rel->published_at->translatedFormat('d M Y') }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </aside>
                @endif

            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        .prose-article {
            color: #9ca3af;
            font-size: 0.9375rem;
            line-height: 1.8;
        }

        .prose-article p {
            margin-bottom: 1.25rem;
        }

        .prose-article h2 {
            color: #fff;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 2rem 0 1rem;
        }

        .prose-article h3 {
            color: #f3f4f6;
            font-size: 1.25rem;
            font-weight: 600;
            margin: 1.5rem 0 0.75rem;
        }

        .prose-article strong {
            color: #e5e7eb;
            font-weight: 600;
        }

        .prose-article a {
            color: #22d3ee;
            text-decoration: underline;
        }

        .prose-article a:hover {
            color: #67e8f9;
        }

        .prose-article ul {
            list-style: disc;
            padding-left: 1.5rem;
            margin-bottom: 1.25rem;
        }

        .prose-article ol {
            list-style: decimal;
            padding-left: 1.5rem;
            margin-bottom: 1.25rem;
        }

        .prose-article li {
            margin-bottom: 0.4rem;
        }

        .prose-article code {
            background: rgba(255, 255, 255, 0.08);
            padding: 0.15rem 0.5rem;
            border-radius: 6px;
            font-size: 0.85em;
            color: #a5f3fc;
        }

        .prose-article pre {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.06);
            border-radius: 12px;
            padding: 1.25rem;
            margin: 1.5rem 0;
            overflow-x: auto;
        }

        .prose-article blockquote {
            border-left: 3px solid #3b82f6;
            padding-left: 1rem;
            color: #6b7280;
            font-style: italic;
            margin: 1.5rem 0;
        }
    </style>
@endpush

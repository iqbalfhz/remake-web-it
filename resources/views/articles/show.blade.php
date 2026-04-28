@extends('layouts.app')

@section('title', $artikel->title . ' - IT Tangcity')

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
                <span class="text-gray-400 truncate max-w-[200px]">{{ $artikel->title }}</span>
            </nav>

            {{-- Categories + Date --}}
            <div class="flex items-center flex-wrap gap-2 mb-5" data-aos="fade-up" data-aos-delay="50">
                @forelse ($artikel->categories as $cat)
                    <a href="{{ route('artikel.index', ['category' => $cat->slug]) }}"
                        class="px-3 py-1 rounded-full bg-blue-600/80 hover:bg-blue-600 text-white text-xs font-semibold transition-colors">{{ $cat->name }}</a>
                @empty
                    <span class="px-3 py-1 rounded-full bg-blue-600/80 text-white text-xs font-semibold">Umum</span>
                @endforelse
                <span class="text-gray-500 text-xs flex items-center gap-1.5">
                    <i class="fa-regular fa-calendar"></i>
                    {{ $artikel->published_at->translatedFormat('d F Y') }}
                </span>
                @if ($artikel->user)
                    <span class="text-gray-500 text-xs flex items-center gap-1.5">
                        <i class="fa-regular fa-user"></i>
                        {{ $artikel->user->name }}
                    </span>
                @endif
            </div>

            {{-- Title --}}
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6" data-aos="fade-up"
                data-aos-delay="100">
                {{ $artikel->title }}
            </h1>

            {{-- Excerpt --}}
            <p class="text-gray-400 text-lg leading-relaxed" data-aos="fade-up" data-aos-delay="150">
                {{ $artikel->excerpt }}
            </p>
        </div>
    </section>

    {{-- Article Image --}}
    @if ($artikel->image)
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-12" data-aos="fade-up">
            <div class="rounded-2xl overflow-hidden" style="border: 1px solid rgba(255,255,255,0.06);">
                <img src="{{ asset('storage/' . $artikel->image) }}" alt="{{ $artikel->title }}"
                    class="w-full max-h-[480px] object-cover">
            </div>
        </div>
    @endif

    {{-- Article Content --}}
    <section class="pb-16 bg-gray-950">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-12">

                {{-- Main Content --}}
                <article class="flex-1 min-w-0" data-aos="fade-up">
                    <div class="prose-article ql-editor-output">
                        {!! $artikel->content !!}
                    </div>

                    {{-- Tags --}}
                    @if ($artikel->tags->isNotEmpty())
                        <div class="mt-8 flex flex-wrap items-center gap-2">
                            <span class="text-xs text-gray-500 mr-1">Tags:</span>
                            @foreach ($artikel->tags as $tag)
                                <span
                                    class="px-2.5 py-1 rounded-full bg-white/5 border border-white/10 text-gray-400 text-xs hover:border-cyan-500/40 hover:text-cyan-400 transition-colors">
                                    #{{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    {{-- Share / Back --}}
                    <div class="mt-12 pt-8 border-t border-white/5 flex items-center justify-between">
                        <a href="{{ route('artikel.index') }}"
                            class="inline-flex items-center gap-2 text-gray-400 hover:text-cyan-400 text-sm transition-colors">
                            <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Artikel
                        </a>
                        <div class="flex items-center gap-3 text-xs text-gray-500">
                            <span>Bagikan:</span>
                            <a href="https://wa.me/?text={{ urlencode($artikel->title . ' - ' . request()->url()) }}"
                                target="_blank" rel="noopener"
                                class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center hover:bg-green-600 text-gray-400 hover:text-white transition-all">
                                <i class="fa-brands fa-whatsapp"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($artikel->title) }}&url={{ urlencode(request()->url()) }}"
                                target="_blank" rel="noopener"
                                class="w-8 h-8 rounded-lg bg-white/5 flex items-center justify-center hover:bg-sky-600 text-gray-400 hover:text-white transition-all">
                                <i class="fa-brands fa-x-twitter"></i>
                            </a>
                        </div>
                    </div>

                    {{-- Comments Section --}}
                    <div class="mt-12 pt-12 border-t border-white/5">

                        <h2 class="text-white text-xl font-bold mb-8">
                            Komentar
                            @if ($artikel->comments->isNotEmpty())
                                <span
                                    class="text-gray-500 font-normal text-base">({{ $artikel->comments->count() }})</span>
                            @endif
                        </h2>

                        {{-- Success flash --}}
                        @if (session('comment_success'))
                            <div
                                class="mb-6 flex items-center gap-3 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-sm">
                                <i class="fa-solid fa-circle-check"></i>
                                {{ session('comment_success') }}
                            </div>
                        @endif

                        {{-- Existing Comments --}}
                        @if ($artikel->comments->isNotEmpty())
                            <div class="space-y-5 mb-12">
                                @foreach ($artikel->comments as $comment)
                                    <div x-data="{ showReply: false }" class="flex gap-4 p-5 rounded-xl"
                                        style="border: 1px solid rgba(255,255,255,0.06); background: rgba(255,255,255,0.02);">
                                        <div
                                            class="w-10 h-10 rounded-full bg-cyan-900/40 flex items-center justify-center shrink-0">
                                            <span
                                                class="text-cyan-400 font-semibold text-sm">{{ strtoupper(substr($comment->name, 0, 1)) }}</span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 mb-1">
                                                <span class="text-white text-sm font-medium">{{ $comment->name }}</span>
                                                <span
                                                    class="text-gray-600 text-xs">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-gray-400 text-sm leading-relaxed">{{ $comment->body }}</p>

                                            {{-- Reply Button --}}
                                            <button @click="showReply = !showReply"
                                                class="mt-2 text-xs text-cyan-500 hover:text-cyan-400 transition-colors flex items-center gap-1">
                                                <i class="fa-solid fa-reply text-[10px]"></i>
                                                <span x-text="showReply ? 'Batal' : 'Balas'"></span>
                                            </button>

                                            {{-- Inline Reply Form --}}
                                            <div x-show="showReply" x-transition
                                                class="mt-4 pl-4 border-l-2 border-white/10">
                                                <form method="POST"
                                                    action="{{ route('artikel.komentar.store', $artikel) }}"
                                                    class="space-y-3">
                                                    @csrf
                                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                                        <input type="text" name="name" value="{{ old('name') }}"
                                                            placeholder="Nama kamu *" required
                                                            class="w-full rounded-lg px-3 py-2 text-sm bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                                        <input type="email" name="email" value="{{ old('email') }}"
                                                            placeholder="email@contoh.com *" required
                                                            class="w-full rounded-lg px-3 py-2 text-sm bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-cyan-500">
                                                    </div>
                                                    <textarea name="body" rows="3" placeholder="Tulis balasanmu..." required
                                                        class="w-full rounded-lg px-3 py-2 text-sm bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 resize-none"></textarea>
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white text-xs font-semibold rounded-lg transition-colors">
                                                        Kirim Balasan
                                                    </button>
                                                </form>
                                            </div>

                                            {{-- Replies --}}
                                            @if ($comment->replies->isNotEmpty())
                                                <div class="mt-4 space-y-3 pl-4 border-l-2 border-white/10">
                                                    @foreach ($comment->replies as $reply)
                                                        <div class="flex gap-3">
                                                            <div
                                                                class="w-8 h-8 rounded-full bg-blue-900/40 flex items-center justify-center shrink-0">
                                                                <span
                                                                    class="text-blue-400 font-semibold text-xs">{{ strtoupper(substr($reply->name, 0, 1)) }}</span>
                                                            </div>
                                                            <div class="flex-1 min-w-0">
                                                                <div class="flex items-center gap-2 mb-1">
                                                                    <span
                                                                        class="text-white text-xs font-medium">{{ $reply->name }}</span>
                                                                    <span
                                                                        class="text-gray-600 text-xs">{{ $reply->created_at->diffForHumans() }}</span>
                                                                </div>
                                                                <p class="text-gray-400 text-xs leading-relaxed">
                                                                    {{ $reply->body }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-600 text-sm mb-12">Belum ada komentar. Jadilah yang pertama!</p>
                        @endif

                        {{-- Comment Form --}}
                        <div class="p-6 rounded-2xl"
                            style="border: 1px solid rgba(255,255,255,0.07); background: rgba(255,255,255,0.02);">
                            <h3 class="text-white font-semibold mb-5">Tinggalkan Komentar</h3>
                            <form method="POST" action="{{ route('artikel.komentar.store', $artikel) }}"
                                class="space-y-4">
                                @csrf
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-medium text-gray-400 mb-1.5">Nama <span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            placeholder="Nama kamu"
                                            class="w-full rounded-lg px-3 py-2.5 text-sm bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('name') border-red-500/60 @enderror">
                                        @error('name')
                                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-medium text-gray-400 mb-1.5">Email <span
                                                class="text-red-500">*</span></label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            placeholder="email@contoh.com"
                                            class="w-full rounded-lg px-3 py-2.5 text-sm bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent @error('email') border-red-500/60 @enderror">
                                        @error('email')
                                            <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-400 mb-1.5">Komentar <span
                                            class="text-red-500">*</span></label>
                                    <textarea name="body" rows="4" placeholder="Tulis komentar kamu..."
                                        class="w-full rounded-lg px-3 py-2.5 text-sm bg-white/5 border border-white/10 text-white placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent resize-none @error('body') border-red-500/60 @enderror">{{ old('body') }}</textarea>
                                    @error('body')
                                        <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="px-6 py-2.5 bg-cyan-600 hover:bg-cyan-700 text-white text-sm font-semibold rounded-lg transition-colors">
                                    Kirim Komentar
                                </button>
                            </form>
                        </div>

                    </div>
                </article>

                {{-- Sidebar: ToC + Related Articles --}}
                <aside class="lg:w-72 shrink-0" data-aos="fade-left">

                    {{-- Table of Contents (populated by JS) --}}
                    <div id="toc-container" class="hidden mb-6">
                        <h3 class="text-white font-semibold text-sm uppercase tracking-wider mb-4">Daftar Isi</h3>
                        <nav id="toc-list" class="space-y-0.5 border-l-2 border-white/10 pl-3 max-h-72 overflow-y-auto">
                        </nav>
                    </div>

                    {{-- Related Articles --}}
                    @if ($related->isNotEmpty())
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
                    @endif

                </aside>

            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const content = document.querySelector('.prose-article');
            const tocList = document.getElementById('toc-list');
            const tocContainer = document.getElementById('toc-container');

            if (!content || !tocList || !tocContainer) return;

            const headings = content.querySelectorAll('h1, h2, h3');
            if (headings.length < 2) return;

            headings.forEach(function(heading, index) {
                const id = 'section-' + index;
                heading.id = id;

                const link = document.createElement('a');
                link.href = '#' + id;
                link.textContent = heading.textContent;

                if (heading.tagName === 'H3') {
                    link.className =
                        'block text-xs text-gray-500 hover:text-cyan-400 py-1 pl-3 transition-colors leading-snug';
                } else if (heading.tagName === 'H2') {
                    link.className =
                        'block text-xs text-gray-300 hover:text-cyan-400 py-1 font-medium transition-colors leading-snug';
                } else {
                    link.className =
                        'block text-xs text-white hover:text-cyan-400 py-1 font-semibold transition-colors leading-snug';
                }

                tocList.appendChild(link);
            });

            tocContainer.classList.remove('hidden');

            // Highlight active heading on scroll
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    const id = entry.target.id;
                    const link = tocList.querySelector('a[href="#' + id + '"]');
                    if (!link) return;
                    if (entry.isIntersecting) {
                        tocList.querySelectorAll('a').forEach(function(a) {
                            a.classList.remove('text-cyan-400');
                        });
                        link.classList.add('text-cyan-400');
                    }
                });
            }, {
                rootMargin: '-20% 0px -70% 0px'
            });

            headings.forEach(function(h) {
                observer.observe(h);
            });
        });
    </script>
@endpush

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

        /* Quill image output */
        .ql-editor-output img {
            max-width: 100%;
            border-radius: 10px;
            margin: 1rem 0;
        }
    </style>
@endpush

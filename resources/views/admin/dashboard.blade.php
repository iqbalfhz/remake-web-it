@extends('admin.layouts.app')

@section('title', 'Dashboard')

@php
    // Helper: growth badge
    function growthBadge(int $current, int $last): array
    {
        if ($last === 0) {
            return ['icon' => '↑', 'text' => 'Bulan ini', 'color' => 'text-slate-400'];
        }
        $pct = round((($current - $last) / $last) * 100);
        if ($pct > 0) {
            return ['icon' => '↑', 'text' => "+{$pct}%", 'color' => 'text-green-600'];
        }
        if ($pct < 0) {
            return ['icon' => '↓', 'text' => "{$pct}%", 'color' => 'text-red-500'];
        }
        return ['icon' => '→', 'text' => '0%', 'color' => 'text-slate-400'];
    }
    $articleGrowth = growthBadge($articlesThisMonth, $articlesLastMonth);
    $commentGrowth = growthBadge($commentsThisMonth, $commentsLastMonth);
    $userGrowth = growthBadge($usersThisMonth, $usersLastMonth);
@endphp

@section('content')

    {{-- ===== GREETING HEADER ===== --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Selamat Datang, {{ Auth::user()->name }} 👋</h1>
            <p class="text-sm text-slate-500 mt-0.5">{{ now()->translatedFormat('l, d F Y') }} &mdash; Admin Panel IT
                Tangcity</p>
        </div>
        <div class="flex items-center gap-2 text-xs text-slate-400">
            <span
                class="inline-flex items-center gap-1.5 bg-green-50 text-green-600 font-medium px-3 py-1.5 rounded-full border border-green-200">
                <span class="size-1.5 rounded-full bg-green-500 animate-pulse"></span>
                Sistem Online
            </span>
        </div>
    </div>

    {{-- ===== ALERT BADGES (unread/pending) ===== --}}
    @if ($unreadComments > 0 || $unreadContacts > 0 || $pendingUsers > 0)
        <div class="flex flex-wrap gap-3 mb-6">
            @if ($unreadComments > 0)
                <a href="{{ route('admin.komentar.index') }}"
                    class="inline-flex items-center gap-2 bg-amber-50 border border-amber-200 text-amber-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-amber-100 transition-colors">
                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-3 3-3-3z" />
                    </svg>
                    {{ $unreadComments }} komentar belum dibaca
                </a>
            @endif
            @if ($unreadContacts > 0)
                <a href="{{ route('admin.contacts.index') }}"
                    class="inline-flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-red-100 transition-colors">
                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    {{ $unreadContacts }} pesan belum dibaca
                </a>
            @endif
            @if ($pendingUsers > 0)
                <a href="{{ route('admin.users.index') }}"
                    class="inline-flex items-center gap-2 bg-blue-50 border border-blue-200 text-blue-700 text-sm font-medium px-4 py-2 rounded-lg hover:bg-blue-100 transition-colors">
                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    {{ $pendingUsers }} pengguna menunggu persetujuan
                </a>
            @endif
        </div>
    @endif

    {{-- ===== STAT CARDS ===== --}}
    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">

        {{-- Artikel --}}
        <a href="{{ route('admin.artikel.index') }}"
            class="group bg-white rounded-xl p-5 shadow-sm border border-slate-200 hover:border-cyan-300 hover:shadow-md transition-all">
            <div class="flex items-start justify-between mb-3">
                <div class="p-2 bg-cyan-50 rounded-lg group-hover:bg-cyan-100 transition-colors">
                    <svg class="size-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <span class="text-xs font-semibold {{ $articleGrowth['color'] }}">{{ $articleGrowth['icon'] }}
                    {{ $articleGrowth['text'] }}</span>
            </div>
            <div class="text-2xl font-bold text-slate-800">{{ $totalArticles }}</div>
            <div class="text-xs text-slate-500 font-medium mt-0.5">Total Artikel</div>
            <div class="mt-2 flex gap-2 text-xs">
                <span class="text-green-600 font-medium">{{ $publishedArticles }} publish</span>
                <span class="text-slate-400">&bull;</span>
                <span class="text-slate-500">{{ $draftArticles }} draft</span>
            </div>
            @if ($totalArticles > 0)
                <div class="mt-2 h-1 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-cyan-400 rounded-full"
                        style="width: {{ round(($publishedArticles / $totalArticles) * 100) }}%"></div>
                </div>
            @endif
        </a>

        {{-- Kategori --}}
        <a href="{{ route('admin.kategori.index') }}"
            class="group bg-white rounded-xl p-5 shadow-sm border border-slate-200 hover:border-violet-300 hover:shadow-md transition-all">
            <div class="flex items-start justify-between mb-3">
                <div class="p-2 bg-violet-50 rounded-lg group-hover:bg-violet-100 transition-colors">
                    <svg class="size-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-bold text-slate-800">{{ $totalCategories }}</div>
            <div class="text-xs text-slate-500 font-medium mt-0.5">Kategori</div>
            <div class="mt-2 text-xs text-slate-400">Semua kategori aktif</div>
        </a>

        {{-- Komentar --}}
        <a href="{{ route('admin.komentar.index') }}"
            class="group bg-white rounded-xl p-5 shadow-sm border border-slate-200 hover:border-amber-300 hover:shadow-md transition-all">
            <div class="flex items-start justify-between mb-3">
                <div class="p-2 bg-amber-50 rounded-lg group-hover:bg-amber-100 transition-colors">
                    <svg class="size-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-3 3-3-3z" />
                    </svg>
                </div>
                <span class="text-xs font-semibold {{ $commentGrowth['color'] }}">{{ $commentGrowth['icon'] }}
                    {{ $commentGrowth['text'] }}</span>
            </div>
            <div class="text-2xl font-bold text-slate-800">{{ $totalComments }}</div>
            <div class="text-xs text-slate-500 font-medium mt-0.5">Komentar</div>
            <div class="mt-2 text-xs {{ $unreadComments > 0 ? 'text-amber-600 font-medium' : 'text-slate-400' }}">
                {{ $unreadComments > 0 ? $unreadComments . ' belum dibaca' : 'Semua sudah dibaca' }}
            </div>
            @if ($totalComments > 0)
                <div class="mt-2 h-1 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-amber-400 rounded-full"
                        style="width: {{ round((($totalComments - $unreadComments) / $totalComments) * 100) }}%"></div>
                </div>
            @endif
        </a>

        {{-- Pesan --}}
        <a href="{{ route('admin.contacts.index') }}"
            class="group bg-white rounded-xl p-5 shadow-sm border border-slate-200 hover:border-red-300 hover:shadow-md transition-all">
            <div class="flex items-start justify-between mb-3">
                <div class="p-2 bg-red-50 rounded-lg group-hover:bg-red-100 transition-colors">
                    <svg class="size-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                @if ($unreadContacts > 0)
                    <span
                        class="text-xs bg-red-100 text-red-600 font-bold px-1.5 py-0.5 rounded-full">{{ $unreadContacts }}</span>
                @endif
            </div>
            <div class="text-2xl font-bold text-slate-800">{{ $totalContacts }}</div>
            <div class="text-xs text-slate-500 font-medium mt-0.5">Pesan Masuk</div>
            <div class="mt-2 text-xs {{ $unreadContacts > 0 ? 'text-red-500 font-medium' : 'text-slate-400' }}">
                {{ $unreadContacts > 0 ? $unreadContacts . ' belum dibaca' : 'Semua sudah dibaca' }}
            </div>
        </a>

        {{-- Pengguna --}}
        <a href="{{ route('admin.users.index') }}"
            class="group bg-white rounded-xl p-5 shadow-sm border border-slate-200 hover:border-green-300 hover:shadow-md transition-all">
            <div class="flex items-start justify-between mb-3">
                <div class="p-2 bg-green-50 rounded-lg group-hover:bg-green-100 transition-colors">
                    <svg class="size-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <span class="text-xs font-semibold {{ $userGrowth['color'] }}">{{ $userGrowth['icon'] }}
                    {{ $userGrowth['text'] }}</span>
            </div>
            <div class="text-2xl font-bold text-slate-800">{{ $totalUsers }}</div>
            <div class="text-xs text-slate-500 font-medium mt-0.5">Pengguna</div>
            <div class="mt-2 text-xs text-slate-400">{{ $activeUsers }} aktif &bull; {{ $pendingUsers }} pending</div>
            @if ($totalUsers > 0)
                <div class="mt-2 h-1 bg-slate-100 rounded-full overflow-hidden">
                    <div class="h-full bg-green-400 rounded-full"
                        style="width: {{ round(($activeUsers / $totalUsers) * 100) }}%"></div>
                </div>
            @endif
        </a>

        {{-- Mailing List --}}
        <a href="{{ route('admin.mailing-list.index') }}"
            class="group bg-white rounded-xl p-5 shadow-sm border border-slate-200 hover:border-indigo-300 hover:shadow-md transition-all">
            <div class="flex items-start justify-between mb-3">
                <div class="p-2 bg-indigo-50 rounded-lg group-hover:bg-indigo-100 transition-colors">
                    <svg class="size-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>
            </div>
            <div class="text-2xl font-bold text-slate-800">{{ $totalMailingList }}</div>
            <div class="text-xs text-slate-500 font-medium mt-0.5">Mailing List</div>
            <div class="mt-2 text-xs text-slate-400">Email terdaftar</div>
        </a>

    </div>

    {{-- ===== CHARTS ROW ===== --}}
    {{-- Chart data injected as JS to avoid breaking HTML attribute parser with JSON quotes --}}
    <script>
        window._chartRangeData = {
            article: @json($articleCharts),
            comment: @json($commentCharts),
            user: @json($userCharts),
        };
        window._dashCharts = {};
    </script>

    <div x-data="{
        range: 6,
        updateCharts() {
            const r = this.range;
            ['articleChart', 'commentChart', 'userChart'].forEach((id, i) => {
                const key = ['article', 'comment', 'user'][i];
                const d = window._chartRangeData[key][r];
                const c = window._dashCharts[id];
                if (!c) return;
                c.data.labels = d.map(x => x.label);
                c.data.datasets[0].data = d.map(x => x.count);
                c.update('active');
            });
        }
    }">

        {{-- Filter bar --}}
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-sm font-semibold text-slate-700">Statistik Aktivitas</h2>
            <div class="flex items-center gap-1 bg-slate-100 rounded-lg p-1">
                @foreach ([3 => '3 Bulan', 6 => '6 Bulan', 12 => '12 Bulan'] as $val => $label)
                    <button @click="range = {{ $val }}; updateCharts()"
                        :class="range === {{ $val }} ? 'bg-white text-slate-800 shadow-sm' :
                            'text-slate-500 hover:text-slate-700'"
                        class="text-xs font-medium px-3 py-1.5 rounded-md transition-all">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- 3 bar/line charts --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-6">

            {{-- Article Chart --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-sm font-semibold text-slate-800">Artikel</h3>
                        <p class="text-xs text-slate-400 mt-0.5"><span x-text="range"></span> bulan terakhir</p>
                    </div>
                    <div class="p-2 bg-cyan-50 rounded-lg">
                        <svg class="size-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                <div class="relative h-44">
                    <canvas id="articleChart"></canvas>
                </div>
            </div>

            {{-- Comment Chart --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-sm font-semibold text-slate-800">Komentar</h3>
                        <p class="text-xs text-slate-400 mt-0.5"><span x-text="range"></span> bulan terakhir</p>
                    </div>
                    <div class="p-2 bg-amber-50 rounded-lg">
                        <svg class="size-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-3 3-3-3z" />
                        </svg>
                    </div>
                </div>
                <div class="relative h-44">
                    <canvas id="commentChart"></canvas>
                </div>
            </div>

            {{-- User Registration Chart --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-sm font-semibold text-slate-800">Registrasi User</h3>
                        <p class="text-xs text-slate-400 mt-0.5"><span x-text="range"></span> bulan terakhir</p>
                    </div>
                    <div class="p-2 bg-green-50 rounded-lg">
                        <svg class="size-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                </div>
                <div class="relative h-44">
                    <canvas id="userChart"></canvas>
                </div>
            </div>

        </div>

        {{-- Category Doughnut Chart --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
            <div class="xl:col-span-1 bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-sm font-semibold text-slate-800">Artikel per Kategori</h3>
                        <p class="text-xs text-slate-400 mt-0.5">Top 8 kategori</p>
                    </div>
                    <div class="p-2 bg-violet-50 rounded-lg">
                        <svg class="size-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                    </div>
                </div>
                <div class="relative h-52">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>

            {{-- Category legend / breakdown --}}
            <div class="xl:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <h3 class="text-sm font-semibold text-slate-800 mb-4">Detail Kategori</h3>
                @php
                    $totalCatArticles = $categoryChart->sum('count');
                    $catColors = [
                        'bg-violet-500',
                        'bg-cyan-500',
                        'bg-amber-400',
                        'bg-green-500',
                        'bg-red-400',
                        'bg-indigo-500',
                        'bg-pink-500',
                        'bg-orange-400',
                    ];
                @endphp
                <div class="space-y-3">
                    @forelse($categoryChart as $i => $cat)
                        <div class="flex items-center gap-3">
                            <span class="size-2.5 rounded-full shrink-0 {{ $catColors[$i % count($catColors)] }}"></span>
                            <span class="text-sm text-slate-700 flex-1 truncate">{{ $cat['label'] }}</span>
                            <span class="text-xs font-semibold text-slate-600 w-6 text-right">{{ $cat['count'] }}</span>
                            <div class="w-28 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                <div class="{{ $catColors[$i % count($catColors)] }} h-full rounded-full"
                                    style="width: {{ $totalCatArticles > 0 ? round(($cat['count'] / $totalCatArticles) * 100) : 0 }}%">
                                </div>
                            </div>
                            <span
                                class="text-xs text-slate-400 w-8 text-right">{{ $totalCatArticles > 0 ? round(($cat['count'] / $totalCatArticles) * 100) : 0 }}%</span>
                        </div>
                    @empty
                        <p class="text-sm text-slate-400 text-center py-8">Belum ada data kategori</p>
                    @endforelse
                </div>
            </div>
        </div>

    </div>{{-- end x-data charts --}}

    {{-- ===== RECENT ACTIVITY ===== --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">

        {{-- Recent Articles --}}
        <div class="xl:col-span-1 bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <h3 class="text-sm font-semibold text-slate-800">Artikel Terbaru</h3>
                <a href="{{ route('admin.artikel.index') }}"
                    class="text-xs text-cyan-600 hover:text-cyan-700 font-medium">Lihat semua &rarr;</a>
            </div>
            <ul class="divide-y divide-slate-100">
                @forelse($recentArticles as $article)
                    <li class="px-6 py-3.5 hover:bg-slate-50 transition-colors">
                        <div class="flex items-start gap-3">
                            <div class="shrink-0 mt-0.5">
                                @if ($article->published_at && $article->published_at <= now())
                                    <span class="inline-block size-2 rounded-full bg-green-500 mt-1.5"></span>
                                @else
                                    <span class="inline-block size-2 rounded-full bg-slate-300 mt-1.5"></span>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm text-slate-700 font-medium truncate">{{ $article->title }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $article->user?->name ?? '—' }} &bull;
                                    {{ $article->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="px-6 py-8 text-center text-sm text-slate-400">Belum ada artikel</li>
                @endforelse
            </ul>
        </div>

        {{-- Recent Comments --}}
        <div class="xl:col-span-1 bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <h3 class="text-sm font-semibold text-slate-800">Komentar Terbaru</h3>
                <a href="{{ route('admin.komentar.index') }}"
                    class="text-xs text-cyan-600 hover:text-cyan-700 font-medium">Lihat semua &rarr;</a>
            </div>
            <ul class="divide-y divide-slate-100">
                @forelse($recentComments as $comment)
                    <li class="px-6 py-3.5 hover:bg-slate-50 transition-colors">
                        <div class="flex items-start gap-3">
                            <div class="shrink-0">
                                @if (!$comment->is_read)
                                    <span class="inline-block size-2 rounded-full bg-amber-400 mt-1.5"></span>
                                @else
                                    <span class="inline-block size-2 rounded-full bg-slate-300 mt-1.5"></span>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm text-slate-700 font-medium truncate">{{ $comment->name }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ Str::limit($comment->body, 60) }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="px-6 py-8 text-center text-sm text-slate-400">Belum ada komentar</li>
                @endforelse
            </ul>
        </div>

        {{-- Recent Contacts --}}
        <div class="xl:col-span-1 bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                <h3 class="text-sm font-semibold text-slate-800">Pesan Terbaru</h3>
                <a href="{{ route('admin.contacts.index') }}"
                    class="text-xs text-cyan-600 hover:text-cyan-700 font-medium">Lihat semua &rarr;</a>
            </div>
            <ul class="divide-y divide-slate-100">
                @forelse($recentContacts as $contact)
                    <li class="px-6 py-3.5 hover:bg-slate-50 transition-colors">
                        <div class="flex items-start gap-3">
                            <div class="shrink-0">
                                @if (!$contact->is_read)
                                    <span class="inline-block size-2 rounded-full bg-red-400 mt-1.5"></span>
                                @else
                                    <span class="inline-block size-2 rounded-full bg-slate-300 mt-1.5"></span>
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm text-slate-700 font-medium truncate">{{ $contact->name }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ Str::limit($contact->message, 60) }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $contact->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="px-6 py-8 text-center text-sm text-slate-400">Belum ada pesan</li>
                @endforelse
            </ul>
        </div>

    </div>

    {{-- ===== PENDING USERS + QUICK ACTIONS ===== --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Pending Users --}}
        @if ($newUsers->isNotEmpty())
            <div class="xl:col-span-2 bg-white rounded-xl shadow-sm border border-slate-200">
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                    <h3 class="text-sm font-semibold text-slate-800">Pengguna Menunggu Persetujuan</h3>
                    <a href="{{ route('admin.users.index') }}"
                        class="text-xs text-cyan-600 hover:text-cyan-700 font-medium">Kelola &rarr;</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-slate-50 text-left">
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Nama
                                </th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Email
                                </th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Daftar
                                </th>
                                <th class="px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wide">Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($newUsers as $user)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-3.5">
                                        <div class="flex items-center gap-2.5">
                                            <div
                                                class="size-7 rounded-full bg-cyan-100 text-cyan-700 flex items-center justify-center text-xs font-bold shrink-0">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <span class="font-medium text-slate-700">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-3.5 text-slate-500">{{ $user->email }}</td>
                                    <td class="px-6 py-3.5 text-slate-400 text-xs">
                                        {{ $user->created_at->diffForHumans() }}</td>
                                    <td class="px-6 py-3.5">
                                        <span
                                            class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full bg-amber-100 text-amber-700">
                                            Pending
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        {{-- Quick Actions --}}
        <div
            class="{{ $newUsers->isNotEmpty() ? 'xl:col-span-1' : 'xl:col-span-3' }} bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="text-sm font-semibold text-slate-800 mb-4">Aksi Cepat</h3>
            <div class="grid {{ $newUsers->isNotEmpty() ? 'grid-cols-1' : 'grid-cols-2 sm:grid-cols-3' }} gap-3">
                @can('artikel.create')
                    <a href="{{ route('admin.artikel.create') }}"
                        class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:border-cyan-300 hover:bg-cyan-50 transition-all group">
                        <div class="p-1.5 bg-cyan-100 rounded-md group-hover:bg-cyan-200 transition-colors">
                            <svg class="size-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </div>
                        <span class="text-sm text-slate-700 font-medium">Tulis Artikel</span>
                    </a>
                @endcan
                @can('kategori.view')
                    <a href="{{ route('admin.kategori.index') }}"
                        class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:border-violet-300 hover:bg-violet-50 transition-all group">
                        <div class="p-1.5 bg-violet-100 rounded-md group-hover:bg-violet-200 transition-colors">
                            <svg class="size-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <span class="text-sm text-slate-700 font-medium">Kelola Kategori</span>
                    </a>
                @endcan
                @can('komentar.view')
                    <a href="{{ route('admin.komentar.index') }}"
                        class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:border-amber-300 hover:bg-amber-50 transition-all group">
                        <div class="p-1.5 bg-amber-100 rounded-md group-hover:bg-amber-200 transition-colors">
                            <svg class="size-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-3 3-3-3z" />
                            </svg>
                        </div>
                        <span class="text-sm text-slate-700 font-medium">Moderasi Komentar</span>
                    </a>
                @endcan
                @can('contacts.view')
                    <a href="{{ route('admin.contacts.index') }}"
                        class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:border-red-300 hover:bg-red-50 transition-all group">
                        <div class="p-1.5 bg-red-100 rounded-md group-hover:bg-red-200 transition-colors">
                            <svg class="size-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-sm text-slate-700 font-medium">Lihat Pesan</span>
                    </a>
                @endcan
                @can('users.view')
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:border-green-300 hover:bg-green-50 transition-all group">
                        <div class="p-1.5 bg-green-100 rounded-md group-hover:bg-green-200 transition-colors">
                            <svg class="size-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <span class="text-sm text-slate-700 font-medium">Kelola Pengguna</span>
                    </a>
                @endcan
                @can('mailing-list.view')
                    <a href="{{ route('admin.mailing-list.index') }}"
                        class="flex items-center gap-3 p-3 rounded-lg border border-slate-200 hover:border-indigo-300 hover:bg-indigo-50 transition-all group">
                        <div class="p-1.5 bg-indigo-100 rounded-md group-hover:bg-indigo-200 transition-colors">
                            <svg class="size-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                        <span class="text-sm text-slate-700 font-medium">Mailing List</span>
                    </a>
                @endcan
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sharedOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleColor: '#94a3b8',
                        bodyColor: '#f1f5f9',
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false,
                    },
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: {
                                size: 11
                            }
                        },
                        border: {
                            display: false
                        },
                    },
                    y: {
                        grid: {
                            color: '#f1f5f9',
                            lineWidth: 1
                        },
                        ticks: {
                            color: '#94a3b8',
                            font: {
                                size: 11
                            },
                            stepSize: 1,
                            precision: 0
                        },
                        border: {
                            display: false
                        },
                        beginAtZero: true,
                    },
                },
            };

            const initRange = 6;

            // Article Chart (bar)
            const articleChart = new Chart(document.getElementById('articleChart'), {
                type: 'bar',
                data: {
                    labels: window._chartRangeData.article[initRange].map(x => x.label),
                    datasets: [{
                        data: window._chartRangeData.article[initRange].map(x => x.count),
                        backgroundColor: 'rgba(6, 182, 212, 0.15)',
                        borderColor: 'rgb(6, 182, 212)',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                        hoverBackgroundColor: 'rgba(6, 182, 212, 0.3)',
                    }],
                },
                options: sharedOptions,
            });

            // Comment Chart (bar)
            const commentChart = new Chart(document.getElementById('commentChart'), {
                type: 'bar',
                data: {
                    labels: window._chartRangeData.comment[initRange].map(x => x.label),
                    datasets: [{
                        data: window._chartRangeData.comment[initRange].map(x => x.count),
                        backgroundColor: 'rgba(251, 191, 36, 0.15)',
                        borderColor: 'rgb(251, 191, 36)',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                        hoverBackgroundColor: 'rgba(251, 191, 36, 0.3)',
                    }],
                },
                options: sharedOptions,
            });

            // User Registration Chart (line)
            const userChart = new Chart(document.getElementById('userChart'), {
                type: 'line',
                data: {
                    labels: window._chartRangeData.user[initRange].map(x => x.label),
                    datasets: [{
                        data: window._chartRangeData.user[initRange].map(x => x.count),
                        borderColor: 'rgb(34, 197, 94)',
                        backgroundColor: 'rgba(34, 197, 94, 0.08)',
                        borderWidth: 2.5,
                        pointBackgroundColor: 'rgb(34, 197, 94)',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4,
                    }],
                },
                options: sharedOptions,
            });

            // Category Doughnut Chart
            const catData = @json($categoryChart); // scalar data, safe in script tag
            const doughnutColors = [
                'rgba(139,92,246,0.85)', 'rgba(6,182,212,0.85)', 'rgba(251,191,36,0.85)',
                'rgba(34,197,94,0.85)', 'rgba(248,113,113,0.85)', 'rgba(99,102,241,0.85)',
                'rgba(236,72,153,0.85)', 'rgba(251,146,60,0.85)'
            ];
            new Chart(document.getElementById('categoryChart'), {
                type: 'doughnut',
                data: {
                    labels: catData.map(x => x.label),
                    datasets: [{
                        data: catData.map(x => x.count),
                        backgroundColor: doughnutColors,
                        borderWidth: 2,
                        borderColor: '#fff',
                        hoverOffset: 6,
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleColor: '#94a3b8',
                            bodyColor: '#f1f5f9',
                            padding: 10,
                            cornerRadius: 8,
                        },
                    },
                },
            });

            // Store chart refs on window so Alpine updateCharts() can access them
            window._dashCharts.articleChart = articleChart;
            window._dashCharts.commentChart = commentChart;
            window._dashCharts.userChart = userChart;
        });
    </script>
@endpush

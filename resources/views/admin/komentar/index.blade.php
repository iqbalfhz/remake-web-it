@extends('admin.layouts.app')

@section('title', 'Komentar')

@section('content')
    <div class="space-y-4">

        @if (session('success'))
            <div
                class="px-4 py-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-700 dark:text-green-400 text-sm rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        {{-- Header --}}
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-semibold text-gray-800 dark:text-white">Komentar</h2>
                    <p class="text-xs text-gray-400">{{ $comments->total() }} komentar dari pembaca</p>
                </div>
            </div>
        </div>

        {{-- Comments Table --}}
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                        <th
                            class="text-left px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Komentator</th>
                        <th
                            class="text-left px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Komentar</th>
                        <th
                            class="text-left px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Artikel</th>
                        <th
                            class="text-left px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Tanggal</th>
                        <th
                            class="text-right px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse ($comments as $komentar)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors" x-data>
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-800 dark:text-white">{{ $komentar->name }}</div>
                                <a href="mailto:{{ $komentar->email }}"
                                    class="text-xs text-cyan-500 hover:underline">{{ $komentar->email }}</a>
                            </td>
                            <td class="px-6 py-4 max-w-xs">
                                <p class="text-gray-600 dark:text-gray-300 line-clamp-2">{{ $komentar->body }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if ($komentar->article)
                                    <a href="{{ route('artikel.show', $komentar->article) }}" target="_blank"
                                        class="text-cyan-600 dark:text-cyan-400 hover:underline line-clamp-1 text-xs">
                                        {{ $komentar->article->title }}
                                    </a>
                                @else
                                    <span class="text-gray-400 text-xs">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-gray-400 whitespace-nowrap">
                                {{ $komentar->created_at->format('d M Y') }}<br>
                                {{ $komentar->created_at->format('H:i') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form method="POST" action="{{ route('admin.komentar.destroy', $komentar) }}"
                                    @submit.prevent="$dispatch('open-confirm', {title: 'Hapus Komentar', message: 'Yakin hapus komentar dari {{ addslashes($komentar->name) }}?', form: $el, type: 'danger'})">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 rounded-lg transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-400">
                                Belum ada komentar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($comments->hasPages())
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 px-6 py-4">
                {{ $comments->links() }}
            </div>
        @endif

    </div>
@endsection

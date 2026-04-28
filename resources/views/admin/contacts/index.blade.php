@extends('admin.layouts.app')

@section('title', 'Pesan Masuk')

@section('content')
    <div class="space-y-4">

        @if (session('success'))
            <div
                class="px-4 py-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-700 dark:text-green-400 text-sm rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        {{-- Header Card --}}
        <div
            class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-cyan-100 dark:bg-cyan-900/40 flex items-center justify-center">
                    <svg class="w-5 h-5 text-cyan-600 dark:text-cyan-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-semibold text-gray-800 dark:text-white">Pesan Masuk</h2>
                    <p class="text-xs text-gray-400">{{ $contacts->total() }} pesan dari pengunjung website</p>
                </div>
            </div>
            @if ($contacts->total() > 0)
                <span
                    class="inline-flex items-center justify-center px-3 py-1 text-xs font-bold text-white bg-cyan-600 rounded-full">
                    {{ $contacts->total() }} pesan
                </span>
            @endif
        </div>

        {{-- Messages --}}
        @forelse ($contacts as $contact)
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                {{-- Sender Header --}}
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 dark:border-gray-700/50">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-cyan-100 dark:bg-cyan-900/40 flex items-center justify-center shrink-0">
                            <span class="text-sm font-bold text-cyan-700 dark:text-cyan-400">
                                {{ strtoupper(substr($contact->name, 0, 1)) }}
                            </span>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span
                                    class="text-sm font-semibold text-gray-800 dark:text-white">{{ $contact->name }}</span>
                                @if (!$contact->is_read)
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 text-xs font-bold text-white bg-red-500 rounded-full">Baru</span>
                                @endif
                                <a href="mailto:{{ $contact->email }}"
                                    class="inline-flex items-center gap-1 text-xs text-cyan-600 dark:text-cyan-400 hover:underline">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    {{ $contact->email }}
                                </a>
                            </div>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="text-xs text-gray-400">
                                    {{ $contact->created_at->format('d M Y, H:i') }}
                                </span>
                                <span class="text-xs text-gray-300 dark:text-gray-600">&middot;</span>
                                <span class="text-xs text-gray-400">{{ $contact->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        {{-- Reply Button --}}
                        <a href="mailto:{{ $contact->email }}?subject=Re: Pesan dari Website IT Tangcity"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-cyan-600 dark:text-cyan-400 bg-cyan-50 dark:bg-cyan-900/30 hover:bg-cyan-100 dark:hover:bg-cyan-900/50 rounded-lg transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                            </svg>
                            Balas
                        </a>
                        @can('contacts.delete')
                            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" x-data
                                @submit.prevent="$dispatch('open-confirm', {title: 'Hapus Pesan', message: $el.dataset.msg, form: $el, type: 'danger'})"
                                data-msg="Yakin hapus pesan dari {{ $contact->name }}? Tindakan ini tidak dapat dibatalkan.">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 rounded-lg transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>

                {{-- Message Body --}}
                <div class="px-6 py-5">
                    <div
                        class="bg-gray-50 dark:bg-gray-700/30 rounded-lg px-4 py-3 border-l-4 border-cyan-400 dark:border-cyan-600">
                        <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line leading-relaxed">
                            {{ $contact->message }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 px-6 py-16 text-center">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <p class="text-sm font-medium text-gray-400">Belum ada pesan masuk</p>
                <p class="text-xs text-gray-300 dark:text-gray-600 mt-1">Pesan dari pengunjung website akan muncul di sini
                </p>
            </div>
        @endforelse

        {{-- Pagination --}}
        @if ($contacts->hasPages())
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 px-6 py-4">
                {{ $contacts->links() }}
            </div>
        @endif

    </div>
@endsection

@extends('admin.layouts.app')

@section('title', 'Pesan Masuk')

@section('content')

    @if (session('success') || session('error'))
        <div x-data="{ show: true }" x-show="show" x-cloak x-init="setTimeout(() => show = false, 4000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4"
            x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-4"
            style="position:fixed;top:24px;right:24px;z-index:250;max-width:360px;width:100%;"
            class="flex items-center gap-3 pl-4 pr-3 py-3.5 rounded-xl border shadow-xl overflow-hidden {{ session('error') ? 'bg-white border-red-200' : 'bg-white border-emerald-200' }}">
            <span
                class="absolute left-0 top-0 bottom-0 w-1 {{ session('error') ? 'bg-red-500' : 'bg-emerald-500' }}"></span>
            @if (session('error'))
                <svg class="w-5 h-5 shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @else
                <svg class="w-5 h-5 shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @endif
            <p
                class="text-sm font-medium flex-1 {{ session('error') ? 'text-red-700' : 'text-emerald-700' }}">
                {{ session('error') ?? session('success') }}
            </p>
            <button @click="show = false"
                class="shrink-0 rounded-lg p-1 transition-colors {{ session('error') ? 'text-red-400 hover:text-red-600 hover:bg-red-100' : 'text-emerald-400 hover:text-emerald-600 hover:bg-emerald-100' }}">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <div class="space-y-4">


        {{-- Header Card --}}
        <div
            class="bg-white rounded-xl shadow-sm border border-slate-200 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-cyan-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-cyan-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-semibold text-slate-800">Pesan Masuk</h2>
                    <p class="text-xs text-slate-400">{{ $contacts->total() }} pesan dari pengunjung website</p>
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
                class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                {{-- Sender Header --}}
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-cyan-100 flex items-center justify-center shrink-0">
                            <span class="text-sm font-bold text-cyan-700">
                                {{ strtoupper(substr($contact->name, 0, 1)) }}
                            </span>
                        </div>
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span
                                    class="text-sm font-semibold text-slate-800">{{ $contact->name }}</span>
                                @if (!$contact->is_read)
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 text-xs font-bold text-white bg-red-500 rounded-full">Baru</span>
                                @endif
                                <a href="mailto:{{ $contact->email }}"
                                    class="inline-flex items-center gap-1 text-xs text-cyan-600 hover:underline">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    {{ $contact->email }}
                                </a>
                            </div>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="text-xs text-slate-400">
                                    {{ $contact->created_at->format('d M Y, H:i') }}
                                </span>
                                <span class="text-xs text-slate-300">&middot;</span>
                                <span class="text-xs text-slate-400">{{ $contact->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        {{-- Reply Button --}}
                        <a href="mailto:{{ $contact->email }}?subject=Re: Pesan dari Website IT Tangcity"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-cyan-600 bg-cyan-50 hover:bg-cyan-100 rounded-lg transition-colors">
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
                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
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
                        class="bg-slate-50 rounded-lg px-4 py-3 border-l-4 border-cyan-400">
                        <p class="text-sm text-slate-700 whitespace-pre-line leading-relaxed">
                            {{ $contact->message }}</p>
                    </div>
                </div>
            </div>
        @empty
            <div
                class="bg-white rounded-xl shadow-sm border border-slate-200 px-6 py-16 text-center">
                <svg class="w-12 h-12 mx-auto mb-3 text-slate-300" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <p class="text-sm font-medium text-slate-400">Belum ada pesan masuk</p>
                <p class="text-xs text-slate-300 mt-1">Pesan dari pengunjung website akan muncul di sini
                </p>
            </div>
        @endforelse

        {{-- Pagination --}}
        @if ($contacts->hasPages())
            <div
                class="bg-white rounded-xl shadow-sm border border-slate-200 px-6 py-4">
                {{ $contacts->links() }}
            </div>
        @endif

    </div>
@endsection

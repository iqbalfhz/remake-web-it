@extends('admin.layouts.app')

@section('title', 'Manajemen Permission')

@section('content')

    @if (session('success') || session('error'))
        <div x-data="{ show: true }" x-show="show" x-cloak x-init="setTimeout(() => show = false, 4000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4"
            x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-4"
            style="position:fixed;top:24px;right:24px;z-index:250;max-width:360px;width:100%;"
            class="flex items-center gap-3 pl-4 pr-3 py-3.5 rounded-xl border shadow-xl overflow-hidden {{ session('error') ? 'bg-white border-red-200 dark:bg-gray-800 dark:border-red-700' : 'bg-white border-emerald-200 dark:bg-gray-800 dark:border-emerald-700' }}">
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
                class="text-sm font-medium flex-1 {{ session('error') ? 'text-red-700 dark:text-red-300' : 'text-emerald-700 dark:text-emerald-300' }}">
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

    <div class="space-y-6" x-data="{ open: {{ $errors->any() ? 'true' : 'false' }} }">


        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div>
                    <h2 class="text-base font-semibold text-gray-800 dark:text-white">Daftar Permission</h2>
                    <p class="text-xs text-gray-400 mt-0.5">Dikelompokkan berdasarkan modul.</p>
                </div>
                <button @click="open = true"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-cyan-600 hover:bg-cyan-700 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Permission
                </button>
            </div>

            <div class="px-6 py-5 space-y-6">
                @forelse ($permissions as $module => $modulePermissions)
                    <div>
                        <h3
                            class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3 pb-2 border-b border-gray-100 dark:border-gray-700">
                            {{ $module }}
                            <span class="normal-case font-normal text-gray-400">({{ $modulePermissions->count() }})</span>
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($modulePermissions as $permission)
                                <div
                                    class="flex items-center gap-2 pl-3 pr-1.5 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-700 group">
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $permission->name }}</span>
                                    <form method="POST" action="{{ route('admin.permissions.destroy', $permission) }}"
                                        x-data
                                        @submit.prevent="$dispatch('open-confirm', {title: 'Hapus Permission', message: $el.dataset.msg, form: $el, type: 'danger'})"
                                        data-msg="Yakin hapus &quot;{{ $permission->name }}&quot;? Role yang menggunakan permission ini akan terpengaruh.">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="p-0.5 rounded text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 transition-colors"
                                            title="Hapus">
                                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <p class="text-center text-sm text-gray-400 py-8">Belum ada permission.</p>
                @endforelse
            </div>

            {{-- Modal Create Permission --}}
            <div x-show="open" x-cloak class="border-t border-gray-200 dark:border-gray-700 px-6 py-5">
                <h3 class="text-sm font-semibold text-gray-800 dark:text-white mb-1">Tambah Permission Baru</h3>
                <p class="text-xs text-gray-400 mb-4">Format: <code
                        class="bg-gray-100 dark:bg-gray-700 px-1 rounded">modul.aksi</code> — contoh:
                    <code class="bg-gray-100 dark:bg-gray-700 px-1 rounded">artikel.view</code>
                </p>
                <form method="POST" action="{{ route('admin.permissions.store') }}" class="flex items-start gap-3">
                    @csrf
                    <div class="flex-1">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="contoh: laporan.view"
                            class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('name') border-red-400 @enderror">
                        @error('name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-semibold text-white bg-cyan-600 hover:bg-cyan-700 rounded-lg transition-colors whitespace-nowrap">
                        Simpan
                    </button>
                    <button type="button" @click="open = false"
                        class="px-4 py-2 text-sm font-medium text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors">
                        Batal
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection

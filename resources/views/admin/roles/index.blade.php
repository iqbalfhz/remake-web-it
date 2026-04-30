@extends('admin.layouts.app')

@section('title', 'Manajemen Role')

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


        {{-- Roles Card --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-base font-semibold text-gray-800 dark:text-white">Daftar Role</h2>
                @can('roles.manage')
                    <button @click="open = true"
                        class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-cyan-600 hover:bg-cyan-700 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Role
                    </button>
                @endcan
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Nama Role</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Jumlah Permission</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Jumlah Pengguna</th>
                            <th
                                class="px-6 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($roles as $role)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <td class="px-6 py-3">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-lg text-sm font-semibold bg-cyan-100 dark:bg-cyan-900/40 text-cyan-700 dark:text-cyan-400">
                                        {{ $role->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 text-gray-600 dark:text-gray-300">
                                    {{ $role->permissions_count }} permission
                                </td>
                                <td class="px-6 py-3 text-gray-600 dark:text-gray-300">
                                    {{ $role->users_count }} pengguna
                                </td>
                                <td class="px-6 py-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @can('roles.manage')
                                            <a href="{{ route('admin.roles.edit', $role) }}"
                                                class="px-3 py-1.5 text-xs font-semibold text-cyan-600 dark:text-cyan-400 bg-cyan-50 dark:bg-cyan-900/30 hover:bg-cyan-100 dark:hover:bg-cyan-900/50 rounded-lg transition-colors">
                                                Atur Permission
                                            </a>
                                            <form method="POST" action="{{ route('admin.roles.destroy', $role) }}" x-data
                                                @submit.prevent="$dispatch('open-confirm', {title: 'Hapus Role', message: $el.dataset.msg, form: $el, type: 'danger'})"
                                                data-msg="Yakin hapus role &quot;{{ $role->name }}&quot;? Semua pengguna dengan role ini akan kehilangan akses.">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-1.5 text-xs font-semibold text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 rounded-lg transition-colors">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-sm text-gray-400">
                                    Belum ada role.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Modal Tambah Role --}}
            <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4"
                @keydown.escape.window="open = false">
                <div class="absolute inset-0 bg-black/50" @click="open = false"></div>
                <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-md">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Tambah Role Baru</h3>
                        <button @click="open = false"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('admin.roles.store') }}" class="p-6 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama Role <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="contoh: moderator"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center gap-3 pt-2">
                            <button type="submit"
                                class="px-5 py-2 bg-cyan-600 hover:bg-cyan-700 text-white text-sm font-medium rounded-lg transition-colors">
                                Simpan
                            </button>
                            <button type="button" @click="open = false"
                                class="px-5 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endsection

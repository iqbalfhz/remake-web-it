@extends('admin.layouts.app')

@section('title', 'Manajemen Role')

@section('content')
    <div class="space-y-6" x-data="{ open: {{ $errors->any() ? 'true' : 'false' }} }">

        @if (session('success'))
            <div
                class="px-4 py-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-700 dark:text-green-400 text-sm rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        {{-- Roles Card --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-base font-semibold text-gray-800 dark:text-white">Daftar Role</h2>
                <button @click="open = true"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-cyan-600 hover:bg-cyan-700 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Role
                </button>
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

            {{-- Modal Create Role --}}
            <div x-show="open" x-cloak class="border-t border-gray-200 dark:border-gray-700 px-6 py-5">
                <h3 class="text-sm font-semibold text-gray-800 dark:text-white mb-4">Tambah Role Baru</h3>
                <form method="POST" action="{{ route('admin.roles.store') }}" class="flex items-start gap-3">
                    @csrf
                    <div class="flex-1">
                        <input type="text" name="name" value="{{ old('name') }}"
                            placeholder="Nama role (contoh: moderator)"
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

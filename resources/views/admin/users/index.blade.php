@extends('admin.layouts.app')

@section('title', 'Manajemen Pengguna')

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

    <div class="space-y-6" x-data="{ open: {{ $errors->hasAny(['name', 'email', 'password', 'role']) ? 'true' : 'false' }} }">


        {{-- Pending Approval --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-3">
                    <h2 class="text-base font-semibold text-gray-800 dark:text-white">Menunggu Persetujuan</h2>
                    @if ($pending->isNotEmpty())
                        <span
                            class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold text-white bg-red-500 rounded-full">
                            {{ $pending->count() }}
                        </span>
                    @endif
                </div>
            </div>

            @if ($pending->isEmpty())
                <div class="px-6 py-12 text-center text-sm text-gray-400">
                    <svg class="w-10 h-10 mx-auto mb-3 text-gray-300 dark:text-gray-600" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Tidak ada pendaftaran yang menunggu persetujuan.
                </div>
            @else
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach ($pending as $user)
                        <div class="flex items-center justify-between px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center shrink-0">
                                    <span class="text-sm font-semibold text-amber-700 dark:text-amber-400">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $user->email }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">Daftar {{ $user->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <form method="POST" action="{{ route('admin.users.approve', $user) }}" x-data
                                    @submit.prevent="$dispatch('open-confirm', {title: 'Setujui Akun', message: $el.dataset.msg, form: $el, type: 'success'})"
                                    data-msg="Setujui pendaftaran {{ $user->name }}? Pengguna akan dapat login ke sistem.">
                                    @csrf @method('PATCH')
                                    <button type="submit"
                                        class="px-3 py-1.5 text-xs font-semibold text-white bg-green-600 hover:bg-green-700 rounded-lg transition-colors">
                                        Setujui
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.users.reject', $user) }}" x-data
                                    @submit.prevent="$dispatch('open-confirm', {title: 'Tolak Pendaftaran', message: $el.dataset.msg, form: $el, type: 'danger'})"
                                    data-msg="Tolak dan hapus akun {{ $user->name }}? Tindakan ini tidak dapat dibatalkan.">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="px-3 py-1.5 text-xs font-semibold text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 rounded-lg transition-colors">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-base font-semibold text-gray-800 dark:text-white">Pengguna Aktif</h2>
                @can('users.create')
                    <button @click="open = true"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Pengguna
                    </button>
                @endcan
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Pengguna</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Email</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Role</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Bergabung</th>
                            <th
                                class="px-6 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($approved as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <td class="px-6 py-3">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-cyan-100 dark:bg-cyan-900/40 flex items-center justify-center shrink-0">
                                            <span class="text-xs font-semibold text-cyan-700 dark:text-cyan-400">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </span>
                                        </div>
                                        <span class="font-medium text-gray-800 dark:text-white">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3 text-gray-600 dark:text-gray-300">{{ $user->email }}</td>
                                <td class="px-6 py-3">
                                    @foreach ($user->roles as $role)
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-cyan-100 dark:bg-cyan-900/40 text-cyan-700 dark:text-cyan-400">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="px-6 py-3">
                                    @if ($user->is_active)
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-400">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-3 text-gray-400 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-3 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        {{-- Edit --}}
                                        @if (Auth::user()->is_admin)
                                            <a href="{{ route('admin.users.edit', $user) }}"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-cyan-700 dark:text-cyan-300 bg-cyan-50 dark:bg-cyan-900/30 hover:bg-cyan-100 dark:hover:bg-cyan-900/50 rounded-lg transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </a>
                                        @endif
                                        {{-- Toggle aktif --}}
                                        @if (Auth::user()->adminTier() < $user->adminTier())
                                            <form method="POST" action="{{ route('admin.users.toggle', $user) }}" x-data
                                                @submit.prevent="$dispatch('open-confirm', {title: $el.dataset.title, message: $el.dataset.msg, form: $el, type: $el.dataset.type})"
                                                data-title="{{ $user->is_active ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}"
                                                data-msg="{{ $user->is_active ? 'Nonaktifkan akun ' . $user->name . '? Pengguna tidak akan bisa login.' : 'Aktifkan kembali akun ' . $user->name . '? Pengguna akan dapat login kembali.' }}"
                                                data-type="{{ $user->is_active ? 'danger' : 'success' }}">
                                                @csrf @method('PATCH')
                                                <button type="submit"
                                                    class="{{ $user->is_active ? 'text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50' : 'text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30 hover:bg-green-100 dark:hover:bg-green-900/50' }} px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors">
                                                    {{ $user->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-400">
                                    Belum ada pengguna aktif.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($approved->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $approved->links() }}
                </div>
            @endif
        </div>

        {{-- Modal Tambah Pengguna --}}
        <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4"
            @keydown.escape.window="open = false">
            <div class="absolute inset-0 bg-black/50" @click="open = false"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-xl w-full max-w-lg">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Tambah Pengguna</h3>
                    <button @click="open = false"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.users.store') }}" class="p-6 space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Nama <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Password <span
                                    class="text-red-500">*</span></label>
                            <input type="password" name="password"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5">Role</label>
                            <select name="role"
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-white px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('role') border-red-500 @enderror">
                                <option value="">Tanpa role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}"
                                        {{ old('role') === $role->name ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('role')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
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

    </div>
@endsection

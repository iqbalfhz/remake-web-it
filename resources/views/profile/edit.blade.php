@extends('admin.layouts.app')

@section('title', 'Profil Saya')

@section('content')

    {{-- Status toast --}}
    @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
        <div x-data="{ show: true }" x-show="show" x-cloak x-init="setTimeout(() => show = false, 3000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4"
            x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-4"
            style="position:fixed;top:24px;right:24px;z-index:250;max-width:360px;width:100%;"
            class="flex items-center gap-3 pl-4 pr-3 py-3.5 rounded-xl border border-emerald-200 bg-white shadow-xl overflow-hidden">
            <span class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-500"></span>
            <svg class="w-5 h-5 shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm font-medium flex-1 text-emerald-700">
                {{ session('status') === 'profile-updated' ? 'Profil berhasil diperbarui.' : 'Password berhasil diperbarui.' }}
            </p>
            <button @click="show = false"
                class="shrink-0 rounded-lg p-1 text-emerald-400 hover:text-emerald-600 hover:bg-emerald-100 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    @endif

    <div class="max-w-3xl space-y-6">

        {{-- Profile Hero Card --}}
        <div class="relative rounded-2xl overflow-hidden shadow-lg"
            style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">

            <div class="relative px-8 py-8 flex items-center gap-6">
                {{-- Avatar --}}
                <div class="w-20 h-20 rounded-2xl flex items-center justify-center text-3xl font-bold text-white shrink-0"
                    style="background: linear-gradient(135deg, #06b6d4 0%, #0e7490 100%);">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>

                {{-- Info --}}
                <div class="flex-1 min-w-0">
                    <h2 class="text-xl font-bold text-white truncate">{{ $user->name }}</h2>
                    <p class="text-sm text-slate-400 truncate mt-0.5">{{ $user->email }}</p>
                    <div class="flex items-center flex-wrap gap-2 mt-3">
                        @foreach ($user->roles as $role)
                            <span
                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-cyan-500/20 text-cyan-300 border border-cyan-500/30">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $role->name }}
                            </span>
                        @endforeach
                        @if ($user->is_admin)
                            <span
                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-violet-500/20 text-violet-300 border border-violet-500/30">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                Admin
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Account status --}}
                <div class="hidden sm:flex flex-col items-end gap-2 shrink-0">
                    <span
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-medium {{ $user->is_active ? 'bg-emerald-500/15 text-emerald-400' : 'bg-red-500/15 text-red-400' }}">
                        <span
                            class="w-1.5 h-1.5 rounded-full {{ $user->is_active ? 'bg-emerald-400' : 'bg-red-400' }}"></span>
                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                    <p class="text-xs text-slate-400">Bergabung {{ $user->created_at->translatedFormat('d M Y') }}</p>
                </div>
            </div>
        </div>

        {{-- Two-column grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Profile Information --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-200">
                    <div class="w-8 h-8 rounded-lg bg-cyan-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-semibold text-slate-800">Informasi Profil</h2>
                        <p class="text-xs text-slate-400">Perbarui nama dan email akun.</p>
                    </div>
                </div>
                <div class="px-6 py-5">
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>
                    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name"
                                class="block text-xs font-semibold text-slate-600 uppercase tracking-wide mb-1.5">Nama</label>
                            <input id="name" name="name" type="text"
                                class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/20 transition-colors"
                                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email"
                                class="block text-xs font-semibold text-slate-600 uppercase tracking-wide mb-1.5">Email</label>
                            <input id="email" name="email" type="email"
                                class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/20 transition-colors"
                                value="{{ old('email', $user->email) }}" required autocomplete="username" />
                            @error('email')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-1">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-cyan-600 hover:bg-cyan-700 rounded-lg transition-colors shadow-sm">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Update Password --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-200">
                    <div class="w-8 h-8 rounded-lg bg-cyan-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-cyan-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-semibold text-slate-800">Ubah Password</h2>
                        <p class="text-xs text-slate-400">Gunakan password yang kuat dan unik.</p>
                    </div>
                </div>
                <div class="px-6 py-5">
                    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                        @csrf
                        @method('put')

                        <div>
                            <label for="update_password_current_password"
                                class="block text-xs font-semibold text-slate-600 uppercase tracking-wide mb-1.5">Password
                                Saat Ini</label>
                            <input id="update_password_current_password" name="current_password" type="password"
                                class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/20 transition-colors"
                                autocomplete="current-password" />
                            @error('current_password', 'updatePassword')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="update_password_password"
                                class="block text-xs font-semibold text-slate-600 uppercase tracking-wide mb-1.5">Password
                                Baru</label>
                            <input id="update_password_password" name="password" type="password"
                                class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/20 transition-colors"
                                autocomplete="new-password" />
                            @error('password', 'updatePassword')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="update_password_password_confirmation"
                                class="block text-xs font-semibold text-slate-600 uppercase tracking-wide mb-1.5">Konfirmasi
                                Password</label>
                            <input id="update_password_password_confirmation" name="password_confirmation"
                                type="password"
                                class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:bg-white focus:border-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-500/20 transition-colors"
                                autocomplete="new-password" />
                            @error('password_confirmation', 'updatePassword')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-1">
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold text-white bg-cyan-600 hover:bg-cyan-700 rounded-lg transition-colors shadow-sm">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Perbarui Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Delete Account --}}
        <div class="bg-white rounded-xl shadow-sm border border-red-100" x-data="{ confirmDelete: false }">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-sm font-semibold text-slate-800">Hapus Akun</h2>
                        <p class="text-xs text-slate-400">Tindakan ini permanen dan tidak dapat dibatalkan.</p>
                    </div>
                </div>
                <button type="button" @click="confirmDelete = true"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-red-600 border border-red-200 hover:bg-red-50 rounded-lg transition-colors">
                    Hapus Akun
                </button>
            </div>

            {{-- Confirmation Modal --}}
            <div x-show="confirmDelete" x-cloak
                class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
                x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4"
                    @click.outside="confirmDelete = false">
                    <div class="px-6 pt-6 pb-4">
                        <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-bold text-slate-800 text-center">Hapus Akun?</h3>
                        <p class="text-sm text-slate-500 text-center mt-1">Semua data Anda akan dihapus secara permanen.
                            Masukkan password untuk konfirmasi.</p>
                    </div>
                    <form method="post" action="{{ route('profile.destroy') }}" class="px-6 pb-6 space-y-4">
                        @csrf
                        @method('delete')
                        <div>
                            <label for="delete_password"
                                class="block text-xs font-semibold text-slate-600 uppercase tracking-wide mb-1.5">Password</label>
                            <input id="delete_password" name="password" type="password"
                                class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-800 focus:bg-white focus:border-red-400 focus:outline-none focus:ring-2 focus:ring-red-400/20 transition-colors"
                                placeholder="Masukkan password Anda" />
                            @error('password', 'userDeletion')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center gap-3 pt-1">
                            <button type="button" @click="confirmDelete = false"
                                class="flex-1 px-4 py-2.5 text-sm font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors">
                                Batal
                            </button>
                            <button type="submit"
                                class="flex-1 px-4 py-2.5 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">
                                Hapus Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('content')
    <div class="max-w-2xl space-y-6">

        {{-- Status toast --}}
        @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
            <div x-data="{ show: true }" x-show="show" x-cloak x-init="setTimeout(() => show = false, 3000)"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4"
                x-transition:enter-end="opacity-100 translate-x-0" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-x-0" x-transition:leave-end="opacity-0 translate-x-4"
                style="position:fixed;top:24px;right:24px;z-index:250;max-width:360px;width:100%;"
                class="flex items-center gap-3 pl-4 pr-3 py-3.5 rounded-xl border border-emerald-200 bg-white shadow-xl overflow-hidden">
                <span class="absolute left-0 top-0 bottom-0 w-1 bg-emerald-500"></span>
                <svg class="w-5 h-5 shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm font-medium flex-1 text-emerald-700">
                    {{ session('status') === 'profile-updated' ? 'Profil berhasil diperbarui.' : 'Password berhasil diperbarui.' }}
                </p>
                <button @click="show = false"
                    class="shrink-0 rounded-lg p-1 text-emerald-400 hover:text-emerald-600 hover:bg-emerald-100 transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- Profile Information --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="text-base font-semibold text-slate-800">Informasi Profil</h2>
                <p class="text-xs text-slate-400 mt-0.5">Perbarui nama dan alamat email akun Anda.</p>
            </div>
            <div class="px-6 py-5">
                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form>
                <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                    @csrf
                    @method('patch')

                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
                        <input id="name" name="name" type="text"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-800 shadow-sm focus:border-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500"
                            value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                        @error('name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                        <input id="email" name="email" type="email"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-800 shadow-sm focus:border-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500"
                            value="{{ old('email', $user->email) }}" required autocomplete="username" />
                        @error('email')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-1">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-cyan-600 hover:bg-cyan-700 rounded-lg transition-colors">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Update Password --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-200">
                <h2 class="text-base font-semibold text-slate-800">Ubah Password</h2>
                <p class="text-xs text-slate-400 mt-0.5">Gunakan password yang panjang dan acak agar akun lebih aman.</p>
            </div>
            <div class="px-6 py-5">
                <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf
                    @method('put')

                    <div>
                        <label for="update_password_current_password"
                            class="block text-sm font-medium text-slate-700 mb-1">Password Saat Ini</label>
                        <input id="update_password_current_password" name="current_password" type="password"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-800 shadow-sm focus:border-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500"
                            autocomplete="current-password" />
                        @error('current_password', 'updatePassword')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="update_password_password"
                            class="block text-sm font-medium text-slate-700 mb-1">Password
                            Baru</label>
                        <input id="update_password_password" name="password" type="password"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-800 shadow-sm focus:border-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500"
                            autocomplete="new-password" />
                        @error('password', 'updatePassword')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="update_password_password_confirmation"
                            class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password</label>
                        <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                            class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-800 shadow-sm focus:border-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500"
                            autocomplete="new-password" />
                        @error('password_confirmation', 'updatePassword')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="pt-1">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-cyan-600 hover:bg-cyan-700 rounded-lg transition-colors">
                            Perbarui Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Delete Account --}}
        <div class="bg-white rounded-xl shadow-sm border border-red-200" x-data="{ confirmDelete: false }">
            <div class="px-6 py-4 border-b border-red-100">
                <h2 class="text-base font-semibold text-red-600">Hapus Akun</h2>
                <p class="text-xs text-slate-400 mt-0.5">Setelah akun dihapus, semua data akan dihapus secara permanen.</p>
            </div>
            <div class="px-6 py-5">
                <button type="button" @click="confirmDelete = true"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">
                    Hapus Akun
                </button>

                {{-- Confirmation Modal --}}
                <div x-show="confirmDelete" x-cloak
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
                    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100">
                    <div class="relative bg-white rounded-xl shadow-xl w-full max-w-md mx-4"
                        @click.outside="confirmDelete = false">
                        <div class="px-6 py-5 border-b border-slate-200">
                            <h3 class="text-base font-semibold text-slate-800">Konfirmasi Hapus Akun</h3>
                            <p class="text-sm text-slate-500 mt-1">Tindakan ini tidak dapat dibatalkan. Masukkan password
                                untuk melanjutkan.</p>
                        </div>
                        <form method="post" action="{{ route('profile.destroy') }}" class="px-6 py-5 space-y-4">
                            @csrf
                            @method('delete')
                            <div>
                                <label for="delete_password"
                                    class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                                <input id="delete_password" name="password" type="password"
                                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-800 shadow-sm focus:border-red-500 focus:outline-none focus:ring-1 focus:ring-red-500"
                                    placeholder="Masukkan password Anda" />
                                @error('password', 'userDeletion')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex items-center justify-end gap-3 pt-2">
                                <button type="button" @click="confirmDelete = false"
                                    class="px-4 py-2 text-sm font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 text-sm font-semibold text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">
                                    Hapus Akun
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

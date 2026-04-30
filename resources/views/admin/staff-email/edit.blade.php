@extends('admin.layouts.app')

@section('title', 'Edit Email Staff')

@section('content')
    <div class="max-w-2xl">
        <div class="mb-4">
            <a href="{{ route('admin.staff-email.index') }}"
                class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-slate-700 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali
            </a>
        </div>

        <form method="POST" action="{{ route('admin.staff-email.update', $staffEmail) }}"
            class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="nama" value="{{ old('nama', $staffEmail->nama) }}"
                        class="w-full rounded-lg border border-slate-300 bg-white text-slate-800 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('nama') border-red-500 @enderror">
                    @error('nama')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">PT <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="pt" value="{{ old('pt', $staffEmail->pt) }}"
                        class="w-full rounded-lg border border-slate-300 bg-white text-slate-800 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('pt') border-red-500 @enderror">
                    @error('pt')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Departemen <span
                        class="text-red-500">*</span></label>
                <input type="text" name="departemen" value="{{ old('departemen', $staffEmail->departemen) }}"
                    class="w-full rounded-lg border border-slate-300 bg-white text-slate-800 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('departemen') border-red-500 @enderror">
                @error('departemen')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Email <span
                            class="text-red-500">*</span></label>
                    <input type="email" name="email" value="{{ old('email', $staffEmail->email) }}"
                        class="w-full rounded-lg border border-slate-300 bg-white text-slate-800 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">Email Workspace</label>
                    <input type="email" name="email_workspace"
                        value="{{ old('email_workspace', $staffEmail->email_workspace) }}"
                        class="w-full rounded-lg border border-slate-300 bg-white text-slate-800 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('email_workspace') border-red-500 @enderror">
                    @error('email_workspace')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                    class="px-5 py-2 bg-cyan-600 hover:bg-cyan-700 text-white text-sm font-medium rounded-lg transition-colors">
                    Perbarui
                </button>
                <a href="{{ route('admin.staff-email.index') }}"
                    class="px-5 py-2 text-sm font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection

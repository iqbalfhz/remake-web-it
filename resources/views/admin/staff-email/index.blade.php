@extends('admin.layouts.app')

@section('title', 'Email Staff')

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

    <div x-data="{ open: {{ $errors->any() ? 'true' : 'false' }} }"
        class="bg-white rounded-xl shadow-sm border border-slate-200">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
            <h2 class="text-base font-semibold text-slate-800">Email Staff</h2>
            @can('staff-email.create')
                <button @click="open = true"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-cyan-600 hover:bg-cyan-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Staff
                </button>
            @endcan
        </div>


        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            Nama</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            PT / Departemen</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            Email</th>
                        <th
                            class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            Email Workspace</th>
                        <th
                            class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($staffEmails as $staff)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-3 font-medium text-slate-800">{{ $staff->nama }}</td>
                            <td class="px-6 py-3 text-slate-600">
                                <div>{{ $staff->pt }}</div>
                                <div class="text-xs text-slate-400">{{ $staff->departemen }}</div>
                            </td>
                            <td class="px-6 py-3 text-slate-600">
                                <a href="mailto:{{ $staff->email }}"
                                    class="hover:text-cyan-600 transition-colors">{{ $staff->email }}</a>
                            </td>
                            <td class="px-6 py-3 text-slate-600">
                                @if ($staff->email_workspace)
                                    <a href="mailto:{{ $staff->email_workspace }}"
                                        class="hover:text-cyan-600 transition-colors">{{ $staff->email_workspace }}</a>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @can('staff-email.edit')
                                        <a href="{{ route('admin.staff-email.edit', $staff) }}"
                                            class="px-3 py-1.5 text-xs font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors">
                                            Edit
                                        </a>
                                    @endcan
                                    @can('staff-email.delete')
                                        <form method="POST" action="{{ route('admin.staff-email.destroy', $staff) }}" x-data
                                            @submit.prevent="$dispatch('open-confirm', {title: 'Hapus Staff Email', message: $el.dataset.msg, form: $el, type: 'danger'})"
                                            data-msg="Yakin hapus data staff {{ $staff->nama }}? Tindakan ini tidak dapat dibatalkan.">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-400">
                                Belum ada data email staff.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($staffEmails->hasPages())
            <div class="px-6 py-4 border-t border-slate-200">
                {{ $staffEmails->links() }}
            </div>
        @endif

        {{-- Modal Tambah Email Staff --}}
        <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4"
            @keydown.escape.window="open = false">
            <div class="absolute inset-0 bg-black/50" @click="open = false"></div>
            <div class="relative bg-white rounded-xl shadow-xl w-full max-w-lg">
                <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
                    <h3 class="text-sm font-semibold text-slate-800">Tambah Email Staff</h3>
                    <button @click="open = false"
                        class="text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form method="POST" action="{{ route('admin.staff-email.store') }}" class="p-6 space-y-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="nama" value="{{ old('nama') }}"
                                class="w-full rounded-lg border border-slate-300 bg-white text-slate-800 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('nama') border-red-500 @enderror">
                            @error('nama')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">PT <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="pt" value="{{ old('pt') }}"
                                class="w-full rounded-lg border border-slate-300 bg-white text-slate-800 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('pt') border-red-500 @enderror">
                            @error('pt')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1.5">Departemen <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="departemen" value="{{ old('departemen') }}"
                            class="w-full rounded-lg border border-slate-300 bg-white text-slate-800 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('departemen') border-red-500 @enderror">
                        @error('departemen')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full rounded-lg border border-slate-300 bg-white text-slate-800 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Email
                                Workspace</label>
                            <input type="email" name="email_workspace" value="{{ old('email_workspace') }}"
                                class="w-full rounded-lg border border-slate-300 bg-white text-slate-800 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-cyan-500 @error('email_workspace') border-red-500 @enderror">
                            @error('email_workspace')
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
                            class="px-5 py-2 text-sm font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.app')

@section('title', 'Email Workspace')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200">
            <div>
                <h2 class="text-base font-semibold text-slate-800">Email Workspace</h2>
                <p class="text-xs text-slate-400 mt-0.5">Staff yang memiliki akun Google Workspace</p>
            </div>
            <a href="{{ route('admin.staff-email.index') }}" class="text-xs text-cyan-600 hover:underline">
                Lihat semua staff â†’
            </a>
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
                            <td class="px-6 py-3">
                                <a href="mailto:{{ $staff->email_workspace }}"
                                    class="inline-flex items-center gap-1.5 text-cyan-600 hover:underline">
                                    <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                        <path
                                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                        <path
                                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                        <path
                                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                                    </svg>
                                    {{ $staff->email_workspace }}
                                </a>
                            </td>
                            <td class="px-6 py-3 text-right">
                                @can('staff-email.edit')
                                    <a href="{{ route('admin.staff-email.edit', $staff) }}"
                                        class="px-3 py-1.5 text-xs font-medium text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors">
                                        Edit
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-400">
                                Belum ada staff dengan email workspace.
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
    </div>
@endsection

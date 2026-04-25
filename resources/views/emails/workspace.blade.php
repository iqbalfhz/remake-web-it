@extends('layouts.app')

@section('title', 'Email Workspace - IT Tangcity')

@section('content')

    {{-- Page Header --}}
    <section class="pt-32 pb-10 bg-gray-950 relative overflow-hidden">
        <div class="absolute inset-0 bg-linear-to-b from-blue-950/30 to-transparent pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div data-aos="fade-up">
                {{-- Breadcrumb --}}
                <nav class="flex items-center gap-2 text-xs text-gray-500 mb-4">
                    <a href="{{ route('home') }}" class="hover:text-cyan-400 transition-colors">Home</a>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    <span class="text-gray-400">Daftar Email</span>
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                    <span class="text-cyan-400 font-medium">Email Workspace</span>
                </nav>
                <span class="text-cyan-400 text-xs font-bold uppercase tracking-widest">Daftar Email</span>
                <h1 class="text-3xl sm:text-4xl font-bold text-white mt-2">
                    Email <span
                        class="text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-400">Workspace</span>
                </h1>
                <p class="text-gray-400 mt-3 max-w-lg">Daftar karyawan yang menggunakan Google Workspace
                    (<span class="text-cyan-400">@tangcitymall.com</span>).</p>
            </div>
        </div>
    </section>

    {{-- Table Section --}}
    <section class="bg-gray-950 pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gray-900 border border-white/5 rounded-2xl overflow-hidden shadow-xl" data-aos="fade-up"
                data-aos-delay="100">

                {{-- Table Controls --}}
                <div
                    class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 p-5 border-b border-white/5">
                    <form method="GET" action="{{ route('email.workspace') }}"
                        class="flex items-center gap-2 text-sm text-gray-400">
                        <span>Show</span>
                        <select name="per_page" onchange="this.form.submit()"
                            class="bg-gray-800 border border-white/10 rounded-lg px-2.5 py-1.5 text-white text-sm focus:outline-none focus:ring-1 focus:ring-cyan-500">
                            @foreach ([10, 25, 50, 100] as $opt)
                                <option value="{{ $opt }}" {{ $perPage == $opt ? 'selected' : '' }}>
                                    {{ $opt }}</option>
                            @endforeach
                        </select>
                        <span>entries</span>
                        <input type="hidden" name="search" value="{{ $search }}">
                    </form>

                    <form method="GET" action="{{ route('email.workspace') }}" class="flex items-center gap-2">
                        <input type="hidden" name="per_page" value="{{ $perPage }}">
                        <div class="relative">
                            <i
                                class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs"></i>
                            <input type="text" name="search" value="{{ $search }}" placeholder="Search..."
                                class="bg-gray-800 border border-white/10 rounded-lg pl-8 pr-4 py-1.5 text-white text-sm placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 w-52">
                        </div>
                    </form>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-800/60">
                                <th
                                    class="text-left px-5 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider w-10">
                                    #</th>
                                <th
                                    class="text-left px-5 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    Nama</th>
                                <th
                                    class="text-left px-5 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    PT</th>
                                <th
                                    class="text-left px-5 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    Departemen</th>
                                <th
                                    class="text-left px-5 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    Email @tangcity.com</th>
                                <th
                                    class="text-left px-5 py-3.5 text-xs font-semibold text-gray-400 uppercase tracking-wider">
                                    <span class="flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-blue-400" viewBox="0 0 24 24" fill="currentColor">
                                            <path
                                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                            <path
                                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                            <path
                                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                            <path
                                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                                        </svg>
                                        Email Google Workspace
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse ($staffs as $i => $staff)
                                <tr class="hover:bg-white/2 transition-colors">
                                    <td class="px-5 py-3.5 text-gray-500 text-xs">
                                        {{ $staffs->firstItem() + $i }}</td>
                                    <td class="px-5 py-3.5 text-gray-200 font-medium">{{ $staff->nama }}</td>
                                    <td class="px-5 py-3.5 text-gray-400 text-xs">{{ $staff->pt }}</td>
                                    <td class="px-5 py-3.5">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-500/10 text-blue-300 border border-blue-500/20">
                                            {{ $staff->departemen }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <a href="mailto:{{ $staff->email }}"
                                            class="text-cyan-400 hover:text-cyan-300 transition-colors">{{ $staff->email }}</a>
                                    </td>
                                    <td class="px-5 py-3.5">
                                        <a href="mailto:{{ $staff->email_workspace }}"
                                            class="text-blue-400 hover:text-blue-300 transition-colors">{{ $staff->email_workspace }}</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-5 py-12 text-center text-gray-500">
                                        <i class="fa-solid fa-envelope-circle-check text-2xl mb-2 block"></i>
                                        Tidak ada data ditemukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Table Footer --}}
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-5 py-4 border-t border-white/5">
                    <p class="text-xs text-gray-500">
                        Showing {{ $staffs->firstItem() ?? 0 }}–{{ $staffs->lastItem() ?? 0 }} of
                        {{ $staffs->total() }} entries
                        @if ($search)
                            <span class="text-cyan-400">(filtered from search: "{{ $search }}")</span>
                        @endif
                    </p>
                    @if ($staffs->hasPages())
                        <div class="flex items-center gap-1">
                            @if ($staffs->onFirstPage())
                                <span class="px-3 py-1.5 rounded-lg text-xs text-gray-600 cursor-not-allowed">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </span>
                            @else
                                <a href="{{ $staffs->previousPageUrl() }}"
                                    class="px-3 py-1.5 rounded-lg text-xs text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </a>
                            @endif

                            @foreach ($staffs->getUrlRange(1, $staffs->lastPage()) as $page => $url)
                                @if ($page == $staffs->currentPage())
                                    <span
                                        class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-linear-to-r from-blue-600 to-cyan-500 text-white">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}"
                                        class="px-3 py-1.5 rounded-lg text-xs text-gray-400 hover:text-white hover:bg-white/5 transition-all">{{ $page }}</a>
                                @endif
                            @endforeach

                            @if ($staffs->hasMorePages())
                                <a href="{{ $staffs->nextPageUrl() }}"
                                    class="px-3 py-1.5 rounded-lg text-xs text-gray-400 hover:text-white hover:bg-white/5 transition-all">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            @else
                                <span class="px-3 py-1.5 rounded-lg text-xs text-gray-600 cursor-not-allowed">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection

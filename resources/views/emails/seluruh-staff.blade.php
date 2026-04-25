@extends('layouts.app')

@section('title', 'Email Seluruh Staff - IT Tangcity')

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
                    <span class="text-cyan-400 font-medium">Email Seluruh Staff</span>
                </nav>
                <span class="text-cyan-400 text-xs font-bold uppercase tracking-widest">Daftar Email</span>
                <h1 class="text-3xl sm:text-4xl font-bold text-white mt-2">
                    Email <span class="text-transparent bg-clip-text bg-linear-to-r from-blue-400 to-cyan-400">Seluruh
                        Staff</span>
                </h1>
                <p class="text-gray-400 mt-3 max-w-lg">Daftar lengkap email seluruh karyawan yang terdaftar di Tangcity
                    Superblock.</p>
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
                    <form method="GET" action="{{ route('email.seluruh-staff') }}"
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

                    <form method="GET" action="{{ route('email.seluruh-staff') }}" class="flex items-center gap-2">
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
                                    Email</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse ($staffs as $i => $staff)
                                <tr class="hover:bg-white/2 transition-colors">
                                    <td class="px-5 py-3.5 text-gray-500 text-xs">
                                        {{ $staffs->firstItem() + $i }}</td>
                                    <td class="px-5 py-3.5 text-gray-200 font-medium">{{ $staff->nama }}</td>
                                    <td class="px-5 py-3.5 text-gray-400">{{ $staff->pt }}</td>
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
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-12 text-center text-gray-500">
                                        <i class="fa-solid fa-users text-2xl mb-2 block"></i>
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

@extends('admin.layouts.app')

@section('title', 'Log Aktivitas')

@section('content')

    <div class="space-y-4">

        {{-- Header --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-indigo-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-base font-semibold text-slate-800">Log Aktivitas</h2>
                    <p class="text-xs text-slate-400">{{ number_format($logs->total()) }} total entri aktivitas</p>
                </div>
            </div>
            <a href="{{ route('admin.activity-log.index') }}"
                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-xs font-medium bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                Reset Filter
            </a>
        </div>

        {{-- Filters --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 px-6 py-4">
            <form method="GET" action="{{ route('admin.activity-log.index') }}"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-3 items-end">

                {{-- Search --}}
                <div class="xl:col-span-2">
                    <label class="block text-xs font-medium text-slate-500 mb-1">Cari Deskripsi</label>
                    <div class="relative">
                        <svg class="absolute left-2.5 top-2 w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari aktivitas..."
                            class="w-full pl-8 pr-3 py-1.5 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400">
                    </div>
                </div>

                {{-- Log Name --}}
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">Modul</label>
                    <select name="log_name"
                        class="w-full px-3 py-1.5 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400">
                        <option value="">Semua Modul</option>
                        @foreach ($logNames as $name)
                            <option value="{{ $name }}" @selected(request('log_name') === $name)>
                                {{ ucfirst($name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Causer --}}
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">Pengguna</label>
                    <select name="causer_id"
                        class="w-full px-3 py-1.5 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400">
                        <option value="">Semua Pengguna</option>
                        @foreach ($causers as $causer)
                            <option value="{{ $causer->id }}" @selected(request('causer_id') == $causer->id)>
                                {{ $causer->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Date From --}}
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">Dari Tanggal</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}"
                        class="w-full px-3 py-1.5 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400">
                </div>

                {{-- Date To + Submit --}}
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">Sampai Tanggal</label>
                    <div class="flex gap-2">
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                            class="flex-1 px-3 py-1.5 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:border-indigo-400">
                        <button type="submit"
                            class="shrink-0 px-3 py-1.5 rounded-lg text-xs font-medium bg-indigo-600 text-white hover:bg-indigo-700 transition-colors">
                            Filter
                        </button>
                    </div>
                </div>

            </form>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            @if ($logs->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 text-slate-400">
                    <svg class="w-12 h-12 mb-3 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <p class="text-sm font-medium text-slate-500">Tidak ada log ditemukan</p>
                    <p class="text-xs text-slate-400 mt-1">Coba ubah filter pencarian</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-slate-100 bg-slate-50">
                                <th
                                    class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider w-40">
                                    Waktu</th>
                                <th
                                    class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                    Aktivitas</th>
                                <th
                                    class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider w-32">
                                    Modul</th>
                                <th
                                    class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider w-36">
                                    Objek</th>
                                <th
                                    class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider w-36">
                                    Pengguna</th>
                                <th
                                    class="text-left px-4 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider w-36">
                                    Detail Perubahan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach ($logs as $log)
                                @php
                                    $event = strtolower($log->event ?? '');
                                    $eventColors = match ($event) {
                                        'created' => ['bg-emerald-100', 'text-emerald-700', 'Dibuat'],
                                        'updated' => ['bg-blue-100', 'text-blue-700', 'Diperbarui'],
                                        'deleted' => ['bg-red-100', 'text-red-700', 'Dihapus'],
                                        'failed' => ['bg-red-100', 'text-red-700', 'Gagal'],
                                        default => [
                                            'bg-slate-100',
                                            'text-slate-600',
                                            ucfirst($log->event ?? 'Manual'),
                                        ],
                                    };
                                    $subjectClass = $log->subject_type ? class_basename($log->subject_type) : '-';
                                @endphp
                                <tr class="hover:bg-slate-50/60 transition-colors align-top" x-data="{ expanded: false }">
                                    <td class="px-4 py-3">
                                        <div class="text-xs text-slate-700 font-medium">
                                            {{ $log->created_at->timezone(config('app.timezone'))->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-slate-400">
                                            {{ $log->created_at->timezone(config('app.timezone'))->format('H:i:s') }}
                                        </div>
                                        <div class="text-xs text-slate-300 mt-0.5">
                                            {{ $log->created_at->diffForHumans() }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="text-sm text-slate-700 font-medium">{{ $log->description }}</p>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                                            {{ ucfirst($log->log_name ?? 'default') }}
                                        </span>
                                        @if ($log->event)
                                            <span
                                                class="mt-1 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $eventColors[0] }} {{ $eventColors[1] }}">
                                                {{ $eventColors[2] }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($log->subject_type)
                                            <span class="text-xs font-mono text-slate-600">{{ $subjectClass }}</span>
                                            @if ($log->subject_id)
                                                <span class="text-xs text-slate-400"> #{{ $log->subject_id }}</span>
                                            @endif
                                        @else
                                            <span class="text-xs text-slate-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($log->causer)
                                            <div class="flex items-center gap-1.5">
                                                <div
                                                    class="w-6 h-6 rounded-full bg-indigo-100 flex items-center justify-center shrink-0 text-xs font-bold text-indigo-600">
                                                    {{ strtoupper(substr($log->causer->name, 0, 1)) }}
                                                </div>
                                                <span class="text-xs text-slate-700">{{ $log->causer->name }}</span>
                                            </div>
                                            @if (isset($log->properties['ip']))
                                                <div class="mt-1">
                                                    <span
                                                        class="font-mono text-xs text-slate-400 bg-slate-100 px-1.5 py-0.5 rounded">
                                                        {{ $log->properties['ip'] }}
                                                    </span>
                                                </div>
                                            @endif
                                        @else
                                            <span class="text-xs text-slate-400">Sistem</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @php
                                            $old = $log->attribute_changes['old'] ?? [];
                                            $attributes = $log->attribute_changes['attributes'] ?? [];
                                            $hasChanges = !empty($old) || !empty($attributes);
                                            $extraProps = collect($log->properties?->toArray() ?? [])->except([
                                                'old',
                                                'attributes',
                                                'ip',
                                                'user_agent',
                                            ]);
                                        @endphp

                                        @if ($hasChanges || $extraProps->isNotEmpty())
                                            <button @click="expanded = !expanded"
                                                class="inline-flex items-center gap-1 text-xs text-indigo-600 hover:text-indigo-800 transition-colors">
                                                <svg class="w-3.5 h-3.5 transition-transform"
                                                    :class="expanded ? 'rotate-90' : ''" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                                <span x-text="expanded ? 'Sembunyikan' : 'Lihat Detail'"></span>
                                            </button>

                                            <div x-show="expanded" x-cloak x-transition class="mt-2 space-y-1 max-w-xs">

                                                {{-- Changed attributes --}}
                                                @if (!empty($attributes))
                                                    <div
                                                        class="text-xs text-slate-500 font-medium uppercase tracking-wide mb-1">
                                                        Nilai Baru</div>
                                                    @foreach ($attributes as $key => $value)
                                                        <div class="flex gap-1.5 text-xs">
                                                            <span
                                                                class="shrink-0 font-medium text-slate-600 min-w-0">{{ $key }}:</span>
                                                            <span class="text-slate-500 break-all">
                                                                @if (is_null($value))
                                                                    <em class="text-slate-400">null</em>
                                                                @elseif(is_bool($value))
                                                                    <span
                                                                        class="{{ $value ? 'text-emerald-600' : 'text-red-500' }}">
                                                                        {{ $value ? 'true' : 'false' }}
                                                                    </span>
                                                                @else
                                                                    {{ Str::limit((string) $value, 80) }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                @endif

                                                {{-- Old values --}}
                                                @if (!empty($old))
                                                    <div
                                                        class="text-xs text-slate-500 font-medium uppercase tracking-wide mt-2 mb-1">
                                                        Nilai Lama</div>
                                                    @foreach ($old as $key => $value)
                                                        <div class="flex gap-1.5 text-xs">
                                                            <span
                                                                class="shrink-0 font-medium text-slate-400 line-through min-w-0">{{ $key }}:</span>
                                                            <span class="text-slate-400 line-through break-all">
                                                                {{ Str::limit((string) ($value ?? 'null'), 80) }}
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                @endif

                                                {{-- Extra properties (e.g. user_agent) --}}
                                                @if ($extraProps->isNotEmpty())
                                                    <div
                                                        class="text-xs text-slate-500 font-medium uppercase tracking-wide mt-2 mb-1">
                                                        Info Tambahan</div>
                                                    @foreach ($extraProps as $key => $value)
                                                        <div class="flex gap-1.5 text-xs">
                                                            <span
                                                                class="shrink-0 font-medium text-slate-600">{{ $key }}:</span>
                                                            <span
                                                                class="text-slate-500 break-all">{{ Str::limit((string) $value, 100) }}</span>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        @else
                                            <span class="text-xs text-slate-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($logs->hasPages())
                    <div class="px-6 py-4 border-t border-slate-100">
                        {{ $logs->links() }}
                    </div>
                @endif
            @endif
        </div>

    </div>

@endsection

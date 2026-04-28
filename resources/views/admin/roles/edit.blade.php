@extends('admin.layouts.app')

@section('title', 'Atur Permission: ' . $role->name)

@section('content')
    <div class="space-y-6">

        @if (session('success'))
            <div
                class="px-4 py-3 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-green-700 dark:text-green-400 text-sm rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div>
                    <h2 class="text-base font-semibold text-gray-800 dark:text-white">
                        Atur Permission untuk Role:
                        <span class="text-cyan-600 dark:text-cyan-400">{{ $role->name }}</span>
                    </h2>
                    <p class="text-xs text-gray-400 mt-0.5">Centang permission yang ingin diberikan ke role ini.</p>
                </div>
                <a href="{{ route('admin.roles.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            </div>

            <form method="POST" action="{{ route('admin.roles.update', $role) }}">
                @csrf @method('PUT')

                <div class="px-6 py-5 space-y-6">
                    @foreach ($permissions as $module => $modulePermissions)
                        <div>
                            <h3
                                class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-3">
                                {{ $module }}
                            </h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
                                @foreach ($modulePermissions as $permission)
                                    <label
                                        class="flex items-center gap-3 px-3 py-2.5 rounded-lg border cursor-pointer transition-colors
                                              {{ in_array($permission->id, $rolePermissions) ? 'bg-cyan-50 dark:bg-cyan-900/20 border-cyan-300 dark:border-cyan-700' : 'bg-white dark:bg-gray-700/30 border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}
                                            class="w-4 h-4 rounded text-cyan-600 border-gray-300 dark:border-gray-600 focus:ring-cyan-500">
                                        <span class="text-sm text-gray-700 dark:text-gray-300">
                                            {{ explode('.', $permission->name)[1] ?? $permission->name }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.roles.index') }}"
                        class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2 text-sm font-semibold text-white bg-cyan-600 hover:bg-cyan-700 rounded-lg transition-colors">
                        Simpan Permission
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

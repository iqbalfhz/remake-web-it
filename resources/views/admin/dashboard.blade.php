@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- Stat cards placeholder --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="text-sm text-gray-500 dark:text-gray-400 font-medium">Selamat Datang</div>
            <div class="mt-1 text-2xl font-bold text-gray-800 dark:text-white">{{ Auth::user()->name }}</div>
            <div class="mt-1 text-xs text-gray-400">Admin Panel IT Tangcity</div>
        </div>
    </div>
@endsection

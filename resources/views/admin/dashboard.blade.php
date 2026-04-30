@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-200">
            <div class="text-sm text-slate-500 font-medium">Selamat Datang</div>
            <div class="mt-1 text-2xl font-bold text-slate-800">{{ Auth::user()->name }}</div>
            <div class="mt-1 text-xs text-slate-400">Admin Panel IT Tangcity</div>
        </div>
    </div>
@endsection

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): View
    {
        $permissions = Permission::orderBy('name')->get()->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });

        return view('admin.permissions.index', compact('permissions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9\-]+\.[a-z]+$/', 'unique:permissions,name'],
        ], [
            'name.regex' => 'Format permission harus: modul.aksi (contoh: artikel.view)',
        ]);

        Permission::create(['name' => $request->name, 'guard_name' => 'web']);

        return back()->with('success', "Permission '{$request->name}' berhasil dibuat.");
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $name = $permission->name;
        $permission->delete();

        return back()->with('success', "Permission '{$name}' berhasil dihapus.");
    }
}

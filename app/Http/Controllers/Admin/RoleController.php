<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): View
    {
        $this->authorize('roles.view');

        $roles = Role::withCount('permissions', 'users')->orderBy('id')->get();

        return view('admin.roles.index', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('roles.manage');

        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
        ]);

        Role::create(['name' => $request->name, 'guard_name' => 'web']);

        return back()->with('success', "Role '{$request->name}' berhasil dibuat.");
    }

    public function edit(Role $role): View
    {
        $this->authorize('roles.manage');

        $permissions = Permission::orderBy('name')->get()->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        });

        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $this->authorize('roles.manage');

        $request->validate([
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ]);

        $permissions = Permission::whereIn('id', $request->input('permissions', []))->get();
        $role->syncPermissions($permissions);

        return redirect()->route('admin.roles.index')->with('success', "Permission role '{$role->name}' berhasil diperbarui.");
    }

    public function destroy(Role $role): RedirectResponse
    {
        $this->authorize('roles.manage');

        $name = $role->name;
        $role->delete();

        return back()->with('success', "Role '{$name}' berhasil dihapus.");
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): View
    {
        $pending = User::where('is_approved', false)
            ->where('is_admin', false)
            ->latest()
            ->get();

        $approved = User::where('is_approved', true)
            ->with('roles')
            ->latest()
            ->paginate(20);

        $roles = Role::orderBy('name')->get();

        return view('admin.users.index', compact('pending', 'approved', 'roles'));
    }

    public function approve(User $user): RedirectResponse
    {
        $user->update(['is_approved' => true]);

        return back()->with('success', "Akun {$user->name} berhasil disetujui.");
    }

    public function reject(User $user): RedirectResponse
    {
        $name = $user->name;
        $user->delete();

        return back()->with('success', "Akun {$name} telah ditolak dan dihapus.");
    }

    public function toggle(User $user): RedirectResponse
    {
        $user->update(['is_active' => ! $user->is_active]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Akun {$user->name} berhasil {$status}.");
    }

    public function assignRole(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'role' => ['nullable', 'string', 'exists:roles,name'],
        ]);

        $user->syncRoles($request->input('role') ? [$request->role] : []);

        return back()->with('success', "Role {$user->name} berhasil diperbarui.");
    }
}

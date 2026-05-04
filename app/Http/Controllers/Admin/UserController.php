<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): View
    {
        $this->authorize('users.view');

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

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('users.create');

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', Password::defaults()],
            'role' => ['nullable', 'string', 'exists:roles,name'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->is_approved = true;
        $user->is_active = true;
        $user->save();

        if (! empty($data['role'])) {
            $user->assignRole($data['role']);
        }

        return back()->with('success', "Akun {$user->name} berhasil dibuat.");
    }

    public function edit(User $user): View
    {
        $this->authorize('users.edit');

        $roles = Role::orderBy('name')->get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $this->authorize('users.edit');

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', Password::defaults()],
            'role' => ['nullable', 'string', 'exists:roles,name'],
        ]);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        if (! empty($data['password'])) {
            $user->update(['password' => Hash::make($data['password'])]);
        }

        $user->syncRoles(! empty($data['role']) ? [$data['role']] : []);

        return redirect()->route('admin.users.index')->with('success', "Akun {$user->name} berhasil diperbarui.");
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('users.delete');

        $name = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "Akun {$name} berhasil dihapus.");
    }

    public function approve(User $user): RedirectResponse
    {
        $this->authorize('users.edit');

        $user->is_approved = true;
        $user->save();

        return back()->with('success', "Akun {$user->name} berhasil disetujui.");
    }

    public function reject(User $user): RedirectResponse
    {
        $this->authorize('users.delete');

        $name = $user->name;
        $user->delete();

        return back()->with('success', "Akun {$name} telah ditolak dan dihapus.");
    }

    public function toggle(User $user): RedirectResponse
    {
        $this->authorize('users.edit');

        $actor = Auth::user();

        if ($actor->adminTier() >= $user->adminTier()) {
            abort(403, 'Anda tidak memiliki izin untuk mengubah status pengguna ini.');
        }

        $user->is_active = ! $user->is_active;
        $user->save();

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Akun {$user->name} berhasil {$status}.");
    }

    public function assignRole(Request $request, User $user): RedirectResponse
    {
        $this->authorize('users.edit');

        $request->validate([
            'role' => ['nullable', 'string', 'exists:roles,name'],
        ]);

        $user->syncRoles($request->input('role') ? [$request->role] : []);

        return back()->with('success', "Role {$user->name} berhasil diperbarui.");
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles & permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions per resource
        $permissions = [
            // KONTEN
            'artikel.view', 'artikel.create', 'artikel.edit', 'artikel.delete',
            'kategori.view', 'kategori.create', 'kategori.edit', 'kategori.delete',
            'komentar.view', 'komentar.delete',
            // KOMUNIKASI
            'contacts.view', 'contacts.delete',
            'mailing-list.view', 'mailing-list.create', 'mailing-list.edit', 'mailing-list.delete',
            'staff-email.view', 'staff-email.create', 'staff-email.edit', 'staff-email.delete',
            'workspace-email.view',
            // SISTEM
            'users.view', 'users.create', 'users.edit', 'users.delete',
            'roles.view', 'roles.manage',
            'permissions.view', 'permissions.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Staff: hanya baca semua konten & komunikasi
        $staff = Role::firstOrCreate(['name' => 'staff']);
        $staff->syncPermissions([
            'artikel.view',
            'kategori.view',
            'komentar.view',
            'contacts.view',
            'mailing-list.view',
            'staff-email.view',
            'workspace-email.view',
        ]);

        // Editor: kelola konten (artikel + kategori), hapus komentar, lihat komunikasi
        $editor = Role::firstOrCreate(['name' => 'editor']);
        $editor->syncPermissions([
            'artikel.view', 'artikel.create', 'artikel.edit',
            'kategori.view', 'kategori.create', 'kategori.edit',
            'komentar.view', 'komentar.delete',
            'contacts.view',
            'mailing-list.view',
            'staff-email.view',
            'workspace-email.view',
        ]);

        // Admin: semua kecuali users.* dan roles/permissions management
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(array_filter($permissions, fn ($p) => ! str_starts_with($p, 'users.') && ! str_starts_with($p, 'roles.') && ! str_starts_with($p, 'permissions.')));

        // Super Admin: semua permissions
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $superAdmin->syncPermissions($permissions);

        // Assign super-admin ke akun Iqbal
        $user = User::where('email', 'iqbal.it@tangcity.com')->first();
        if ($user) {
            $user->assignRole('super-admin');
        }
    }
}

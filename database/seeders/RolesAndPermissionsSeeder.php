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
            'artikel.view', 'artikel.create', 'artikel.edit', 'artikel.delete',
            'contacts.view', 'contacts.delete',
            'mailing-list.view', 'mailing-list.create', 'mailing-list.edit', 'mailing-list.delete',
            'staff-email.view', 'staff-email.create', 'staff-email.edit', 'staff-email.delete',
            'users.view', 'users.create', 'users.edit', 'users.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Editor: konten saja
        $editor = Role::firstOrCreate(['name' => 'editor']);
        $editor->syncPermissions([
            'artikel.view', 'artikel.create', 'artikel.edit',
            'contacts.view',
            'mailing-list.view',
            'staff-email.view',
        ]);

        // Admin: semua kecuali kelola users
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions(array_filter($permissions, fn ($p) => ! str_starts_with($p, 'users.')));

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

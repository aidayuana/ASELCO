<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat Permission
        $permissions = [
            'manage users',
            'manage courses',
            'manage schools',
            'attend course'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat Role dan Tetapkan Permission ke Role
        $roleSuperAdmin = Role::firstOrCreate(['name' => 'superadmin']);
        $roleSuperAdmin->givePermissionTo(['manage users', 'manage courses', 'manage schools']);

        $roleSchoolAdmin = Role::firstOrCreate(['name' => 'schooladmin']);
        $roleSchoolAdmin->givePermissionTo(['manage courses', 'manage schools']);

        $roleTeacher = Role::firstOrCreate(['name' => 'teacher']);
        $roleTeacher->givePermissionTo(['manage courses']);

        $roleStudent = Role::firstOrCreate(['name' => 'student']);
        $roleStudent->givePermissionTo(['attend course']);
    }
}

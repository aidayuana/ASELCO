<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Creating roles
        $roles = [
            'superadmin' => Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']),
            'schooladmin' => Role::firstOrCreate(['name' => 'schooladmin', 'guard_name' => 'web']),
            'teacher' => Role::firstOrCreate(['name' => 'teacher', 'guard_name' => 'web']),
            'student' => Role::firstOrCreate(['name' => 'student', 'guard_name' => 'web']),
        ];

        // Creating permissions
        $permissions = [
            'add user', 'edit user', 'delete user', // User management
            'create course', 'edit course', 'delete course', // Course management
            'select course', // Specific for schooladmin
            'add module', // Specific for teacher
            'view course', 'download module' // Specific for student
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Assigning all permissions to all roles
        foreach ($roles as $role) {
            $role->givePermissionTo(Permission::all());
        }
    }
}

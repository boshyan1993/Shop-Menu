<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        $admin = Role::firstOrCreate(
            ['slug' => 'admin'],
            [
                'name' => 'Administrator',
                'description' => 'Full system access',
            ]
        );

        $user = Role::firstOrCreate(
            ['slug' => 'user'],
            [
                'name' => 'User',
                'description' => 'Regular user access',
            ]
        );

        // Permissions
        $permissions = [
            'products.view' => 'View products',
            'products.create' => 'Create products',
            'products.edit' => 'Edit products',
            'products.delete' => 'Delete products',
            'menu.view' => 'View menu',
            'menu.manage' => 'Manage menu',
            'users.view' => 'View users',
            'users.manage' => 'Manage users',
        ];

        foreach ($permissions as $slug => $name) {
            Permission::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'description' => $name,
                ]
            );
        }

        // Assign all permissions to admin
        $admin->permissions()->sync(
            Permission::all()->pluck('id')
        );

        // Assign basic permission to user
        $user->permissions()->sync(
            Permission::whereIn('slug', [
                'products.view',
                'menu.view',
            ])->pluck('id')
        );
    }
}

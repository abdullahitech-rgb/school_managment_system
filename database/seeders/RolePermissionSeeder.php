<?php

namespace Database\Seeders;

use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = config('role_permissions');

        foreach ($roles as $roleKey => $roleData) {
            foreach ($roleData['categories'] as $category => $permissions) {
                foreach ($permissions as $permission) {
                    RolePermission::create([
                        'role' => $roleKey,
                        'category' => $category,
                        'permission' => $permission,
                    ]);
                }
            }
        }
    }
}

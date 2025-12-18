<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (\App\Enums\PermissionEnum::cases() as $permission) {
            \App\Models\Permission::firstOrCreate([
                'name' => $permission->value,
                'description' => $permission->description(),
            ]);
        }

        foreach (\App\Enums\RoleEnum::cases() as $role) {
            $roleModel = \App\Models\Role::firstOrCreate([
                'name' => $role->value,
            ]);

            if ($role === \App\Enums\RoleEnum::ADMIN) {
                $allPermissions = \App\Models\Permission::all();
                $roleModel->permissions()->sync($allPermissions->pluck('id')->toArray());
            }
        }
    }
}

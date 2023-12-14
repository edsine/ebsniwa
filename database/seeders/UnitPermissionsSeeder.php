<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UnitPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'manage unit',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'create unit',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view unit',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'edit unit',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'delete unit',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert permissions
        $inserted = Permission::insert($permissions);

        // Find the company role
        $companyRole = Role::find(4);

        // Assign permissions to the company role
        $companyRole->syncPermissions(Permission::pluck('name'));

        // Alternatively, you can specify the permissions manually
        // $companyRole->syncPermissions(['manage unit', 'create unit', 'view unit', 'edit unit', 'delete unit']);
    }
}

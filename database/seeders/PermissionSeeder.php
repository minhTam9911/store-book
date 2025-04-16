<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = [
            'role-create',
            'role-read',
            'role-update',
            'role-delete'
        ];
        foreach( $permission as $key ) {
            Permission::create([
                'name' => $key,
                'desciption' =>str_random(50),
                'is_active' =>true,
            ]
        );
        }
    }
}

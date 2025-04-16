<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = [
            'Super admin',
            'Admin',
            'Employee',
            'User',
            'Reader',
            'More-v1'
        ];
        foreach ($role as $key => $value) {
            Role::create([
                'name' => $value,
                'description' => str_random(50),
                'is_active' => true
            ]);
        }
    }
}

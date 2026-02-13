<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = \App\Models\Tenant::first();
        $adminRole = \App\Models\Role::where('slug', 'admin')->first();

        $admin = \App\Models\User::create([
            'tenant_id' => $tenant->id,
            'name' => 'Admin User',
            'email' => 'admin@drake.com',
            'password' => bcrypt('password'),
            'active' => true,
        ]);
        $admin->roles()->attach($adminRole);

        $manager = \App\Models\User::create([
            'tenant_id' => $tenant->id,
            'name' => 'Manager User',
            'email' => 'manager@drake.com',
            'password' => bcrypt('password'),
            'active' => true,
        ]);
        $managerRole = \App\Models\Role::where('slug', 'manager')->first();
        $manager->roles()->attach($managerRole);
    }
}

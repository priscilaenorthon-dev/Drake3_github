<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = \App\Models\Tenant::first();
        
        $adminRole = \App\Models\Role::create([
            'tenant_id' => $tenant->id,
            'name' => 'Administrator',
            'slug' => 'admin',
            'description' => 'Full system access',
        ]);

        $managerRole = \App\Models\Role::create([
            'tenant_id' => $tenant->id,
            'name' => 'Manager',
            'slug' => 'manager',
            'description' => 'Manager access',
        ]);

        $userRole = \App\Models\Role::create([
            'tenant_id' => $tenant->id,
            'name' => 'User',
            'slug' => 'user',
            'description' => 'Basic user access',
        ]);

        // Assign all permissions to admin
        $allPermissions = \App\Models\Permission::all();
        $adminRole->permissions()->attach($allPermissions);

        // Assign specific permissions to manager
        $managerPermissions = \App\Models\Permission::whereIn('slug', [
            'view-dashboard',
            'view-collaborators',
            'create-collaborator',
            'edit-collaborator',
            'view-schedules',
            'create-schedule',
            'approve-schedule',
            'view-training-records',
            'view-vacation-requests',
            'approve-vacation-request',
            'view-reports',
        ])->get();
        $managerRole->permissions()->attach($managerPermissions);

        // Assign basic permissions to user
        $userPermissions = \App\Models\Permission::whereIn('slug', [
            'view-dashboard',
            'view-collaborators',
            'view-schedules',
            'view-training-records',
        ])->get();
        $userRole->permissions()->attach($userPermissions);
    }
}

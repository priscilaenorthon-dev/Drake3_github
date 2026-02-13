<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Dashboard
            ['name' => 'View Dashboard', 'slug' => 'view-dashboard', 'resource' => 'dashboard', 'action' => 'view'],
            
            // Companies
            ['name' => 'View Companies', 'slug' => 'view-companies', 'resource' => 'companies', 'action' => 'view'],
            ['name' => 'Create Company', 'slug' => 'create-company', 'resource' => 'companies', 'action' => 'create'],
            ['name' => 'Edit Company', 'slug' => 'edit-company', 'resource' => 'companies', 'action' => 'edit'],
            ['name' => 'Delete Company', 'slug' => 'delete-company', 'resource' => 'companies', 'action' => 'delete'],
            
            // Users
            ['name' => 'View Users', 'slug' => 'view-users', 'resource' => 'users', 'action' => 'view'],
            ['name' => 'Create User', 'slug' => 'create-user', 'resource' => 'users', 'action' => 'create'],
            ['name' => 'Edit User', 'slug' => 'edit-user', 'resource' => 'users', 'action' => 'edit'],
            ['name' => 'Delete User', 'slug' => 'delete-user', 'resource' => 'users', 'action' => 'delete'],
            
            // Collaborators
            ['name' => 'View Collaborators', 'slug' => 'view-collaborators', 'resource' => 'collaborators', 'action' => 'view'],
            ['name' => 'Create Collaborator', 'slug' => 'create-collaborator', 'resource' => 'collaborators', 'action' => 'create'],
            ['name' => 'Edit Collaborator', 'slug' => 'edit-collaborator', 'resource' => 'collaborators', 'action' => 'edit'],
            ['name' => 'Delete Collaborator', 'slug' => 'delete-collaborator', 'resource' => 'collaborators', 'action' => 'delete'],
            
            // Schedules
            ['name' => 'View Schedules', 'slug' => 'view-schedules', 'resource' => 'schedules', 'action' => 'view'],
            ['name' => 'Create Schedule', 'slug' => 'create-schedule', 'resource' => 'schedules', 'action' => 'create'],
            ['name' => 'Edit Schedule', 'slug' => 'edit-schedule', 'resource' => 'schedules', 'action' => 'edit'],
            ['name' => 'Delete Schedule', 'slug' => 'delete-schedule', 'resource' => 'schedules', 'action' => 'delete'],
            ['name' => 'Approve Schedule', 'slug' => 'approve-schedule', 'resource' => 'schedules', 'action' => 'approve'],
            
            // Compliance
            ['name' => 'View Qualifications', 'slug' => 'view-qualifications', 'resource' => 'qualifications', 'action' => 'view'],
            ['name' => 'Manage Trainings', 'slug' => 'manage-trainings', 'resource' => 'trainings', 'action' => 'manage'],
            ['name' => 'View Training Records', 'slug' => 'view-training-records', 'resource' => 'training-records', 'action' => 'view'],
            
            // Logistics
            ['name' => 'View Travel Requests', 'slug' => 'view-travel-requests', 'resource' => 'travel-requests', 'action' => 'view'],
            ['name' => 'Create Travel Request', 'slug' => 'create-travel-request', 'resource' => 'travel-requests', 'action' => 'create'],
            ['name' => 'Approve Travel Request', 'slug' => 'approve-travel-request', 'resource' => 'travel-requests', 'action' => 'approve'],
            
            // HR
            ['name' => 'View Vacation Requests', 'slug' => 'view-vacation-requests', 'resource' => 'vacation-requests', 'action' => 'view'],
            ['name' => 'Create Vacation Request', 'slug' => 'create-vacation-request', 'resource' => 'vacation-requests', 'action' => 'create'],
            ['name' => 'Approve Vacation Request', 'slug' => 'approve-vacation-request', 'resource' => 'vacation-requests', 'action' => 'approve'],
            ['name' => 'Manage Timesheets', 'slug' => 'manage-timesheets', 'resource' => 'timesheets', 'action' => 'manage'],
            
            // Operations
            ['name' => 'View Activities', 'slug' => 'view-activities', 'resource' => 'activities', 'action' => 'view'],
            ['name' => 'Record Activity', 'slug' => 'record-activity', 'resource' => 'activities', 'action' => 'create'],
            ['name' => 'View Reports', 'slug' => 'view-reports', 'resource' => 'reports', 'action' => 'view'],
            
            // Admin
            ['name' => 'Manage Roles', 'slug' => 'manage-roles', 'resource' => 'roles', 'action' => 'manage'],
            ['name' => 'View Audit Logs', 'slug' => 'view-audit-logs', 'resource' => 'audit-logs', 'action' => 'view'],
        ];

        foreach ($permissions as $permission) {
            \App\Models\Permission::create($permission);
        }
    }
}

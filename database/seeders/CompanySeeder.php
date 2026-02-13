<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = \App\Models\Tenant::first();

        $company = \App\Models\Company::create([
            'tenant_id' => $tenant->id,
            'name' => 'ACME Corporation',
            'legal_name' => 'ACME Corporation LTDA',
            'tax_id' => '12.345.678/0001-90',
            'email' => 'contact@acme.com',
            'phone' => '+55 11 98765-4321',
            'address' => 'Av. Paulista, 1000 - São Paulo, SP',
            'active' => true,
        ]);

        // Create units
        $unit1 = \App\Models\Unit::create([
            'tenant_id' => $tenant->id,
            'company_id' => $company->id,
            'name' => 'Plataforma Alpha',
            'code' => 'ALPHA',
            'description' => 'Offshore platform Alpha',
            'active' => true,
        ]);

        $unit2 = \App\Models\Unit::create([
            'tenant_id' => $tenant->id,
            'company_id' => $company->id,
            'name' => 'Base Logística',
            'code' => 'BASE',
            'description' => 'Main logistics base',
            'active' => true,
        ]);

        // Create locations
        \App\Models\Location::create([
            'tenant_id' => $tenant->id,
            'unit_id' => $unit1->id,
            'name' => 'Deck Principal',
            'type' => 'platform',
            'active' => true,
        ]);

        \App\Models\Location::create([
            'tenant_id' => $tenant->id,
            'unit_id' => $unit2->id,
            'name' => 'Armazém 1',
            'type' => 'warehouse',
            'active' => true,
        ]);

        // Create positions
        $position1 = \App\Models\Position::create([
            'tenant_id' => $tenant->id,
            'name' => 'Técnico de Operações',
            'code' => 'TECOP',
            'description' => 'Operations technician',
            'level' => 'technician',
            'active' => true,
        ]);

        $position2 = \App\Models\Position::create([
            'tenant_id' => $tenant->id,
            'name' => 'Supervisor',
            'code' => 'SUP',
            'description' => 'Operations supervisor',
            'level' => 'supervisor',
            'active' => true,
        ]);

        // Create teams
        $team1 = \App\Models\Team::create([
            'tenant_id' => $tenant->id,
            'unit_id' => $unit1->id,
            'name' => 'Equipe A',
            'code' => 'TEAM-A',
            'description' => 'Main operations team',
            'active' => true,
        ]);

        // Create shifts
        \App\Models\Shift::create([
            'tenant_id' => $tenant->id,
            'name' => 'Turno Dia',
            'code' => 'DAY',
            'start_time' => '07:00',
            'end_time' => '19:00',
            'duration_hours' => 12,
            'type' => 'day',
            'active' => true,
        ]);

        \App\Models\Shift::create([
            'tenant_id' => $tenant->id,
            'name' => 'Turno Noite',
            'code' => 'NIGHT',
            'start_time' => '19:00',
            'end_time' => '07:00',
            'duration_hours' => 12,
            'type' => 'night',
            'active' => true,
        ]);

        // Create sample collaborators
        \App\Models\Collaborator::create([
            'tenant_id' => $tenant->id,
            'company_id' => $company->id,
            'position_id' => $position1->id,
            'team_id' => $team1->id,
            'employee_number' => 'EMP001',
            'first_name' => 'João',
            'last_name' => 'Silva',
            'email' => 'joao.silva@acme.com',
            'phone' => '+55 11 91234-5678',
            'hire_date' => now()->subYear(),
            'status' => 'active',
        ]);

        \App\Models\Collaborator::create([
            'tenant_id' => $tenant->id,
            'company_id' => $company->id,
            'position_id' => $position2->id,
            'team_id' => $team1->id,
            'employee_number' => 'EMP002',
            'first_name' => 'Maria',
            'last_name' => 'Santos',
            'email' => 'maria.santos@acme.com',
            'phone' => '+55 11 91234-5679',
            'hire_date' => now()->subMonths(6),
            'status' => 'active',
        ]);
    }
}

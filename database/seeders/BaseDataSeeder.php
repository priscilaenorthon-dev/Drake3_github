<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BaseDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenant = \App\Models\Tenant::first();

        // Create qualifications
        $qual1 = \App\Models\Qualification::create([
            'tenant_id' => $tenant->id,
            'name' => 'NR-10 - Segurança em Instalações Elétricas',
            'code' => 'NR10',
            'description' => 'Treinamento obrigatório para trabalhos com eletricidade',
            'category' => 'safety',
            'requires_certification' => true,
            'validity_days' => 730, // 2 years
            'active' => true,
        ]);

        $qual2 = \App\Models\Qualification::create([
            'tenant_id' => $tenant->id,
            'name' => 'NR-35 - Trabalho em Altura',
            'code' => 'NR35',
            'description' => 'Treinamento para trabalhos acima de 2 metros',
            'category' => 'safety',
            'requires_certification' => true,
            'validity_days' => 730,
            'active' => true,
        ]);

        // Create trainings
        \App\Models\Training::create([
            'tenant_id' => $tenant->id,
            'qualification_id' => $qual1->id,
            'name' => 'Curso NR-10 Básico',
            'code' => 'NR10-BASIC',
            'description' => 'Curso básico de segurança em instalações elétricas',
            'type' => 'presencial',
            'duration_hours' => 40,
            'passing_score' => 70.00,
            'active' => true,
        ]);

        \App\Models\Training::create([
            'tenant_id' => $tenant->id,
            'qualification_id' => $qual2->id,
            'name' => 'Curso NR-35',
            'code' => 'NR35-BASIC',
            'description' => 'Curso de trabalho em altura',
            'type' => 'presencial',
            'duration_hours' => 8,
            'passing_score' => 70.00,
            'active' => true,
        ]);

        // Create sample work schedules
        $collaborators = \App\Models\Collaborator::all();
        $shift = \App\Models\Shift::first();

        foreach ($collaborators as $collaborator) {
            for ($i = 0; $i < 7; $i++) {
                \App\Models\WorkSchedule::create([
                    'tenant_id' => $tenant->id,
                    'collaborator_id' => $collaborator->id,
                    'shift_id' => $shift->id,
                    'schedule_date' => now()->addDays($i),
                    'status' => 'planned',
                ]);
            }
        }

        // Create sample training records
        $training = \App\Models\Training::first();
        foreach ($collaborators as $collaborator) {
            \App\Models\TrainingRecord::create([
                'tenant_id' => $tenant->id,
                'collaborator_id' => $collaborator->id,
                'training_id' => $training->id,
                'completion_date' => now()->subMonths(3),
                'expiration_date' => now()->addMonths(21),
                'score' => 85.50,
                'status' => 'completed',
            ]);
        }
    }
}

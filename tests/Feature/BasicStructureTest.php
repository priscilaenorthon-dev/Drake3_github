<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BasicStructureTest extends TestCase
{
    /**
     * Test that models exist.
     */
    public function test_models_exist(): void
    {
        $models = [
            'Tenant',
            'User',
            'Role',
            'Permission',
            'Company',
            'Unit',
            'Location',
            'Position',
            'Team',
            'Shift',
            'Collaborator',
            'WorkSchedule',
            'Qualification',
            'Training',
            'TrainingRecord',
        ];

        foreach ($models as $model) {
            $className = "App\\Models\\{$model}";
            $this->assertTrue(
                class_exists($className),
                "Model {$model} does not exist"
            );
        }
    }

    /**
     * Test that controllers exist.
     */
    public function test_controllers_exist(): void
    {
        $controllers = [
            'DashboardController',
            'CompanyController',
            'CollaboratorController',
            'WorkScheduleController',
            'TrainingController',
        ];

        foreach ($controllers as $controller) {
            $className = "App\\Http\\Controllers\\{$controller}";
            $this->assertTrue(
                class_exists($className),
                "Controller {$controller} does not exist"
            );
        }
    }

    /**
     * Test that key routes are defined.
     */
    public function test_routes_are_defined(): void
    {
        $this->assertTrue(
            \Illuminate\Support\Facades\Route::has('login'),
            'Login route not defined'
        );
        
        $this->assertTrue(
            \Illuminate\Support\Facades\Route::has('dashboard'),
            'Dashboard route not defined'
        );
        
        $this->assertTrue(
            \Illuminate\Support\Facades\Route::has('companies.index'),
            'Companies index route not defined'
        );
    }
}

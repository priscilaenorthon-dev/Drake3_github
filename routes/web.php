<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CollaboratorController;
use App\Http\Controllers\WorkScheduleController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ShiftController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    
    // Companies
    Route::resource('companies', CompanyController::class);
    
    // Units
    Route::resource('units', UnitController::class);
    
    // Positions
    Route::resource('positions', PositionController::class);
    
    // Teams
    Route::resource('teams', TeamController::class);
    
    // Shifts
    Route::resource('shifts', ShiftController::class);
    
    // Collaborators
    Route::resource('collaborators', CollaboratorController::class);
    
    // Work Schedules
    Route::resource('work-schedules', WorkScheduleController::class);
    
    // Trainings
    Route::resource('trainings', TrainingController::class);
});

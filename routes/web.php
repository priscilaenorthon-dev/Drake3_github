<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CollaboratorController;
use App\Http\Controllers\WorkScheduleController;
use App\Http\Controllers\TrainingController;

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    
    // Companies
    Route::resource('companies', CompanyController::class);
    
    // Collaborators
    Route::resource('collaborators', CollaboratorController::class);
    
    // Work Schedules
    Route::resource('work-schedules', WorkScheduleController::class);
    
    // Trainings
    Route::resource('trainings', TrainingController::class);
});

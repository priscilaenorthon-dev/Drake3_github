<?php

namespace App\Http\Controllers;

use App\Models\WorkSchedule;
use App\Models\TrainingRecord;
use App\Models\VacationRequest;
use App\Models\TravelRequest;
use App\Models\Collaborator;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tenant_id = auth()->user()->tenant_id;

        // Today's schedules
        $todaySchedules = WorkSchedule::where('tenant_id', $tenant_id)
            ->where('schedule_date', now()->toDateString())
            ->with('collaborator', 'shift')
            ->get();

        // Expiring trainings (next 30 days)
        $expiringTrainings = TrainingRecord::where('tenant_id', $tenant_id)
            ->whereBetween('expiration_date', [now(), now()->addDays(30)])
            ->with('collaborator', 'training')
            ->get();

        // Pending approvals
        $pendingVacations = VacationRequest::where('tenant_id', $tenant_id)
            ->where('status', 'pending')
            ->count();

        $pendingTravel = TravelRequest::where('tenant_id', $tenant_id)
            ->where('status', 'pending')
            ->count();

        // Active collaborators
        $activeCollaborators = Collaborator::where('tenant_id', $tenant_id)
            ->where('status', 'active')
            ->count();

        // Statistics
        $stats = [
            'today_schedules' => $todaySchedules->count(),
            'expiring_trainings' => $expiringTrainings->count(),
            'pending_approvals' => $pendingVacations + $pendingTravel,
            'active_collaborators' => $activeCollaborators,
        ];

        return view('dashboard.index', compact(
            'stats',
            'todaySchedules',
            'expiringTrainings',
            'pendingVacations',
            'pendingTravel'
        ));
    }
}

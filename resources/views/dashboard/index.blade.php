@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
</div>

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card border-primary">
            <div class="card-body">
                <h5 class="card-title text-primary">
                    <i class="bi bi-calendar-check"></i> Today's Schedules
                </h5>
                <h2 class="card-text">{{ $stats['today_schedules'] }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card border-warning">
            <div class="card-body">
                <h5 class="card-title text-warning">
                    <i class="bi bi-exclamation-triangle"></i> Expiring Trainings
                </h5>
                <h2 class="card-text">{{ $stats['expiring_trainings'] }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card border-info">
            <div class="card-body">
                <h5 class="card-title text-info">
                    <i class="bi bi-clock-history"></i> Pending Approvals
                </h5>
                <h2 class="card-text">{{ $stats['pending_approvals'] }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card border-success">
            <div class="card-body">
                <h5 class="card-title text-success">
                    <i class="bi bi-people"></i> Active Collaborators
                </h5>
                <h2 class="card-text">{{ $stats['active_collaborators'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Today's Work Schedules</h5>
            </div>
            <div class="card-body">
                @if($todaySchedules->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Collaborator</th>
                                    <th>Shift</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($todaySchedules->take(10) as $schedule)
                                <tr>
                                    <td>{{ $schedule->collaborator->full_name }}</td>
                                    <td>{{ $schedule->shift->name }}</td>
                                    <td>
                                        <span class="badge bg-{{ $schedule->status === 'planned' ? 'primary' : 'success' }}">
                                            {{ ucfirst($schedule->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($todaySchedules->count() > 10)
                        <a href="{{ route('work-schedules.index') }}" class="btn btn-sm btn-outline-primary">
                            View all {{ $todaySchedules->count() }} schedules
                        </a>
                    @endif
                @else
                    <p class="text-muted">No schedules for today.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Expiring Trainings (Next 30 Days)</h5>
            </div>
            <div class="card-body">
                @if($expiringTrainings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Collaborator</th>
                                    <th>Training</th>
                                    <th>Expiration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($expiringTrainings->take(10) as $record)
                                <tr>
                                    <td>{{ $record->collaborator->full_name }}</td>
                                    <td>{{ $record->training->name }}</td>
                                    <td>
                                        <span class="badge bg-warning text-dark">
                                            {{ $record->expiration_date->format('d/m/Y') }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($expiringTrainings->count() > 10)
                        <a href="{{ route('trainings.index') }}" class="btn btn-sm btn-outline-warning">
                            View all {{ $expiringTrainings->count() }} expiring trainings
                        </a>
                    @endif
                @else
                    <p class="text-muted">No trainings expiring in the next 30 days.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Pending Approvals</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Vacation Requests</h6>
                        <p class="text-muted">{{ $pendingVacations }} pending</p>
                    </div>
                    <div class="col-md-6">
                        <h6>Travel Requests</h6>
                        <p class="text-muted">{{ $pendingTravel }} pending</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

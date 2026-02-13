@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h2 mb-0">
            <i class="bi bi-speedometer2 text-primary"></i> Dashboard
        </h1>
        <p class="text-muted small mb-0">Visão geral do sistema</p>
    </div>
    <div>
        <span class="badge bg-primary"><i class="bi bi-calendar3"></i> {{ now()->format('d/m/Y H:i') }}</span>
    </div>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="card kpi-card border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="text-muted">
                            <i class="bi bi-calendar-check"></i> Escalas Hoje
                        </h5>
                        <h2 class="text-primary">{{ $stats['today_schedules'] }}</h2>
                        <p class="text-muted small mb-0">
                            <i class="bi bi-arrow-up text-success"></i> Operação normal
                        </p>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                        <i class="bi bi-calendar3 text-primary" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card kpi-card border-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="text-muted">
                            <i class="bi bi-exclamation-triangle"></i> Treinamentos Vencendo
                        </h5>
                        <h2 class="text-warning">{{ $stats['expiring_trainings'] }}</h2>
                        <p class="text-muted small mb-0">
                            @if($stats['expiring_trainings'] > 0)
                                <i class="bi bi-exclamation-circle text-warning"></i> Requer atenção
                            @else
                                <i class="bi bi-check-circle text-success"></i> Em conformidade
                            @endif
                        </p>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                        <i class="bi bi-award text-warning" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card kpi-card border-info">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="text-muted">
                            <i class="bi bi-clock-history"></i> Aprovações Pendentes
                        </h5>
                        <h2 class="text-info">{{ $stats['pending_approvals'] }}</h2>
                        <p class="text-muted small mb-0">
                            @if($stats['pending_approvals'] > 0)
                                <i class="bi bi-hourglass text-info"></i> Aguardando ação
                            @else
                                <i class="bi bi-check-circle text-success"></i> Tudo aprovado
                            @endif
                        </p>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded">
                        <i class="bi bi-clipboard-check text-info" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="card kpi-card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="text-muted">
                            <i class="bi bi-people"></i> Colaboradores Ativos
                        </h5>
                        <h2 class="text-success">{{ $stats['active_collaborators'] }}</h2>
                        <p class="text-muted small mb-0">
                            <i class="bi bi-check-circle text-success"></i> 100% operacional
                        </p>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded">
                        <i class="bi bi-people-fill text-success" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Area -->
<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-calendar-week text-primary"></i> Escalas de Trabalho - Hoje
                </h5>
                <a href="{{ route('work-schedules.index') }}" class="btn btn-sm btn-outline-primary">
                    Ver todas <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body p-0">
                @if($todaySchedules->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Colaborador</th>
                                    <th>Turno</th>
                                    <th>Horário</th>
                                    <th>Status</th>
                                    <th class="text-end">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($todaySchedules->take(8) as $schedule)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                                <i class="bi bi-person-fill text-primary"></i>
                                            </div>
                                            <strong>{{ $schedule->collaborator->full_name }}</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="bi bi-clock"></i> {{ $schedule->shift->name }}
                                    </td>
                                    <td class="text-muted">
                                        {{ $schedule->shift->start_time }} - {{ $schedule->shift->end_time }}
                                    </td>
                                    <td>
                                        @if($schedule->status === 'planned')
                                            <span class="badge bg-primary">
                                                <i class="bi bi-calendar-check"></i> Planejado
                                            </span>
                                        @elseif($schedule->status === 'confirmed')
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle"></i> Confirmado
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                {{ ucfirst($schedule->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-primary" title="Ver detalhes">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($todaySchedules->count() > 8)
                        <div class="card-footer bg-light">
                            <a href="{{ route('work-schedules.index') }}" class="text-decoration-none">
                                <i class="bi bi-plus-circle"></i> Ver mais {{ $todaySchedules->count() - 8 }} escalas
                            </a>
                        </div>
                    @endif
                @else
                    <div class="text-center py-5 text-muted">
                        <i class="bi bi-calendar-x" style="font-size: 3rem;"></i>
                        <p class="mt-2 mb-0">Nenhuma escala programada para hoje.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-exclamation-triangle text-warning"></i> Alertas
                </h5>
            </div>
            <div class="card-body">
                <!-- Expiring Trainings Alert -->
                @if($expiringTrainings->count() > 0)
                    <div class="alert alert-warning mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-exclamation-triangle-fill me-2 mt-1"></i>
                            <div>
                                <strong>{{ $expiringTrainings->count() }} treinamentos</strong> vencem nos próximos 30 dias
                                <a href="{{ route('trainings.index') }}" class="d-block mt-1 small">Ver detalhes →</a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Pending Approvals Alert -->
                @if($pendingVacations > 0)
                    <div class="alert alert-info mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-clock-fill me-2 mt-1"></i>
                            <div>
                                <strong>{{ $pendingVacations }} solicitações de férias</strong> aguardando aprovação
                            </div>
                        </div>
                    </div>
                @endif

                @if($pendingTravel > 0)
                    <div class="alert alert-info mb-3">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-airplane-fill me-2 mt-1"></i>
                            <div>
                                <strong>{{ $pendingTravel }} solicitações de viagem</strong> aguardando aprovação
                            </div>
                        </div>
                    </div>
                @endif

                @if($expiringTrainings->count() == 0 && $pendingVacations == 0 && $pendingTravel == 0)
                    <div class="text-center py-4 text-muted">
                        <i class="bi bi-check-circle" style="font-size: 3rem; color: #198754;"></i>
                        <p class="mt-2 mb-0">Nenhum alerta no momento!</p>
                        <small>Sistema operando normalmente</small>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Expiring Trainings Table -->
@if($expiringTrainings->count() > 0)
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-award text-warning"></i> Treinamentos a Vencer (Próximos 30 Dias)
                </h5>
                <a href="{{ route('trainings.index') }}" class="btn btn-sm btn-outline-warning">
                    Gerenciar <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Colaborador</th>
                                <th>Treinamento</th>
                                <th>Conclusão</th>
                                <th>Validade</th>
                                <th>Dias Restantes</th>
                                <th class="text-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expiringTrainings->take(10) as $record)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-2">
                                            <i class="bi bi-person-fill text-warning"></i>
                                        </div>
                                        <strong>{{ $record->collaborator->full_name }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <i class="bi bi-award"></i> {{ $record->training->name }}
                                </td>
                                <td class="text-muted">
                                    {{ $record->completion_date->format('d/m/Y') }}
                                </td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        {{ $record->expiration_date->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $daysLeft = now()->diffInDays($record->expiration_date, false);
                                    @endphp
                                    @if($daysLeft <= 7)
                                        <span class="badge bg-danger">
                                            <i class="bi bi-exclamation-triangle"></i> {{ $daysLeft }} dias
                                        </span>
                                    @elseif($daysLeft <= 15)
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-exclamation-circle"></i> {{ $daysLeft }} dias
                                        </span>
                                    @else
                                        <span class="badge bg-info">
                                            {{ $daysLeft }} dias
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-outline-primary" title="Agendar reciclagem">
                                        <i class="bi bi-calendar-plus"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

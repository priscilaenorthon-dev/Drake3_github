@extends('layouts.app')

@section('title', 'Escalas de Trabalho')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h2 mb-0">
            <i class="bi bi-calendar-week text-primary"></i> Escalas de Trabalho
        </h1>
        <p class="text-muted small mb-0">Gerenciar escalas e turnos de trabalho</p>
    </div>
    <div>
        <a href="{{ route('work-schedules.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nova Escala
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white">
        <div class="row g-3 align-items-center">
            <div class="col-md-3">
                <label class="form-label small mb-0">Filtrar por data:</label>
                <input type="date" class="form-control form-control-sm" value="{{ now()->format('Y-m-d') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small mb-0">Status:</label>
                <select class="form-select form-select-sm">
                    <option value="">Todos</option>
                    <option value="planned">Planejado</option>
                    <option value="confirmed">Confirmado</option>
                    <option value="completed">Completo</option>
                </select>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-sm btn-outline-primary mt-4">
                    <i class="bi bi-search"></i> Filtrar
                </button>
                <button class="btn btn-sm btn-outline-secondary mt-4">
                    <i class="bi bi-arrow-clockwise"></i> Limpar
                </button>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        @if(isset($workSchedules) && $workSchedules->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 20%">Colaborador</th>
                            <th style="width: 15%">Data</th>
                            <th style="width: 15%">Turno</th>
                            <th style="width: 15%">Horário</th>
                            <th style="width: 15%">Local</th>
                            <th style="width: 10%" class="text-center">Status</th>
                            <th style="width: 5%" class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($workSchedules as $schedule)
                        <tr>
                            <td class="text-muted">#{{ $schedule->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                        <i class="bi bi-person-fill text-primary"></i>
                                    </div>
                                    <strong>{{ $schedule->collaborator->full_name }}</strong>
                                </div>
                            </td>
                            <td>
                                <i class="bi bi-calendar3"></i> {{ $schedule->schedule_date->format('d/m/Y') }}
                            </td>
                            <td>
                                <i class="bi bi-clock"></i> {{ $schedule->shift->name }}
                            </td>
                            <td class="text-muted small">
                                {{ $schedule->shift->start_time }} - {{ $schedule->shift->end_time }}
                            </td>
                            <td>
                                @if($schedule->location)
                                    <i class="bi bi-geo-alt"></i> {{ $schedule->location->name }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($schedule->status === 'planned')
                                    <span class="badge bg-primary">
                                        <i class="bi bi-calendar-check"></i> Planejado
                                    </span>
                                @elseif($schedule->status === 'confirmed')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Confirmado
                                    </span>
                                @elseif($schedule->status === 'completed')
                                    <span class="badge bg-info">
                                        <i class="bi bi-check-all"></i> Completo
                                    </span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($schedule->status) }}</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('work-schedules.show', $schedule) }}" 
                                       class="btn btn-outline-info" 
                                       title="Visualizar">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('work-schedules.edit', $schedule) }}" 
                                       class="btn btn-outline-warning"
                                       title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-calendar-week" style="font-size: 4rem; color: #dee2e6;"></i>
                <p class="mt-3 text-muted">Nenhuma escala encontrada.</p>
                <a href="{{ route('work-schedules.create') }}" class="btn btn-primary mt-2">
                    <i class="bi bi-plus-circle"></i> Criar Primeira Escala
                </a>
            </div>
        @endif
    </div>
    
    @if(isset($workSchedules) && $workSchedules->hasPages())
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Mostrando {{ $workSchedules->firstItem() }} a {{ $workSchedules->lastItem() }} de {{ $workSchedules->total() }} escalas
                </div>
                <div>
                    {{ $workSchedules->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

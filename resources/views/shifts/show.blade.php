@extends('layouts.app')

@section('title', 'Detalhes do Turno')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h2 mb-0">
            <i class="bi bi-clock-fill text-primary"></i> Detalhes do Turno
        </h1>
        <p class="text-muted small mb-0">{{ $shift->name }}</p>
    </div>
    <div>
        <a href="{{ route('shifts.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        <a href="{{ route('shifts.edit', $shift) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Editar
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informações Básicas</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th style="width: 30%">Nome:</th>
                        <td>{{ $shift->name }}</td>
                    </tr>
                    <tr>
                        <th>Código:</th>
                        <td>{{ $shift->code ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tipo:</th>
                        <td>{{ ucfirst($shift->type ?? '-') }}</td>
                    </tr>
                    <tr>
                        <th>Início:</th>
                        <td>{{ $shift->start_time }}</td>
                    </tr>
                    <tr>
                        <th>Fim:</th>
                        <td>{{ $shift->end_time }}</td>
                    </tr>
                    <tr>
                        <th>Duração:</th>
                        <td>{{ $shift->duration_hours }} horas</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            @if($shift->active)
                                <span class="badge bg-success">Ativo</span>
                            @else
                                <span class="badge bg-secondary">Inativo</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Uso</h5>
            </div>
            <div class="card-body">
                <div class="text-center p-3">
                    <h3 class="mb-0">{{ $shift->workSchedules->count() }}</h3>
                    <small class="text-muted">Escalas com este turno</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

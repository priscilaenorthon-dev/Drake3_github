@extends('layouts.app')

@section('title', 'Detalhes do Treinamento')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h2 mb-0">
            <i class="bi bi-award-fill text-primary"></i> Detalhes do Treinamento
        </h1>
        <p class="text-muted small mb-0">{{ $training->name }}</p>
    </div>
    <div>
        <a href="{{ route('trainings.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        <a href="{{ route('trainings.edit', $training) }}" class="btn btn-primary">
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
                        <th style="width: 40%">Nome:</th>
                        <td>{{ $training->name }}</td>
                    </tr>
                    <tr>
                        <th>Código:</th>
                        <td>{{ $training->code ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Qualificação:</th>
                        <td>{{ $training->qualification->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tipo:</th>
                        <td>
                            @if($training->type == 'online')
                                <span class="badge bg-info">Online</span>
                            @else
                                <span class="badge bg-primary">Presencial</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Duração:</th>
                        <td>{{ $training->duration_hours }} horas</td>
                    </tr>
                    <tr>
                        <th>Nota Mínima:</th>
                        <td>{{ $training->passing_score ?? '-' }}%</td>
                    </tr>
                    <tr>
                        <th>Descrição:</th>
                        <td>{{ $training->description ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            @if($training->active)
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
                <h5 class="mb-0">Registros</h5>
            </div>
            <div class="card-body">
                <div class="text-center p-3">
                    <h3 class="mb-0">{{ $training->trainingRecords->count() }}</h3>
                    <small class="text-muted">Registros de conclusão</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Detalhes do Colaborador')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h2 mb-0">
            <i class="bi bi-people-fill text-primary"></i> Detalhes do Colaborador
        </h1>
        <p class="text-muted small mb-0">{{ $collaborator->full_name }}</p>
    </div>
    <div>
        <a href="{{ route('collaborators.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        <a href="{{ route('collaborators.edit', $collaborator) }}" class="btn btn-primary">
            <i class="bi bi-pencil"></i> Editar
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Informações Pessoais</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th style="width: 40%">Nome Completo:</th>
                        <td>{{ $collaborator->full_name }}</td>
                    </tr>
                    <tr>
                        <th>Matrícula:</th>
                        <td>{{ $collaborator->employee_number ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>E-mail:</th>
                        <td>{{ $collaborator->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Telefone:</th>
                        <td>{{ $collaborator->phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Data de Contratação:</th>
                        <td>{{ $collaborator->hire_date ? $collaborator->hire_date->format('d/m/Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            @if($collaborator->status == 'active')
                                <span class="badge bg-success">Ativo</span>
                            @elseif($collaborator->status == 'on_leave')
                                <span class="badge bg-warning">Afastado</span>
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
                <h5 class="mb-0">Informações Profissionais</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <tr>
                        <th style="width: 40%">Empresa:</th>
                        <td>{{ $collaborator->company->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Cargo:</th>
                        <td>{{ $collaborator->position->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Equipe:</th>
                        <td>{{ $collaborator->team->name ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="mb-0">Estatísticas</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <h3 class="mb-0">{{ $collaborator->workSchedules->count() }}</h3>
                            <small class="text-muted">Escalas</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <h3 class="mb-0">{{ $collaborator->trainingRecords->count() }}</h3>
                            <small class="text-muted">Treinamentos</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

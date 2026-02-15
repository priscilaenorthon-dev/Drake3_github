@extends('layouts.app')

@section('title', 'Detalhes da Equipe')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h2 mb-0">
            <i class="bi bi-people text-primary"></i> Detalhes da Equipe
        </h1>
        <p class="text-muted small mb-0">{{ $team->name }}</p>
    </div>
    <div>
        <a href="{{ route('teams.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        <a href="{{ route('teams.edit', $team) }}" class="btn btn-primary">
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
                        <td>{{ $team->name }}</td>
                    </tr>
                    <tr>
                        <th>Código:</th>
                        <td>{{ $team->code ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Unidade:</th>
                        <td>{{ $team->unit->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Líder:</th>
                        <td>{{ $team->leader->name ?? 'Sem líder' }}</td>
                    </tr>
                    <tr>
                        <th>Descrição:</th>
                        <td>{{ $team->description ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            @if($team->active)
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
                <h5 class="mb-0">Membros</h5>
            </div>
            <div class="card-body">
                <div class="text-center p-3">
                    <h3 class="mb-0">{{ $team->collaborators->count() }}</h3>
                    <small class="text-muted">Colaboradores na equipe</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

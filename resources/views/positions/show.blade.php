@extends('layouts.app')

@section('title', 'Detalhes do Cargo')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h2 mb-0">
            <i class="bi bi-briefcase-fill text-primary"></i> Detalhes do Cargo
        </h1>
        <p class="text-muted small mb-0">{{ $position->name }}</p>
    </div>
    <div>
        <a href="{{ route('positions.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        <a href="{{ route('positions.edit', $position) }}" class="btn btn-primary">
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
                        <td>{{ $position->name }}</td>
                    </tr>
                    <tr>
                        <th>Código:</th>
                        <td>{{ $position->code ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Nível:</th>
                        <td>{{ $position->level ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Descrição:</th>
                        <td>{{ $position->description ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            @if($position->active)
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
                <h5 class="mb-0">Colaboradores</h5>
            </div>
            <div class="card-body">
                <div class="text-center p-3">
                    <h3 class="mb-0">{{ $position->collaborators->count() }}</h3>
                    <small class="text-muted">Colaboradores neste cargo</small>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

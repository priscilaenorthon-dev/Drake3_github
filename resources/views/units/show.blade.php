@extends('layouts.app')

@section('title', 'Detalhes da Unidade')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h2 mb-0">
            <i class="bi bi-geo-alt-fill text-primary"></i> Detalhes da Unidade
        </h1>
        <p class="text-muted small mb-0">{{ $unit->name }}</p>
    </div>
    <div>
        <a href="{{ route('units.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Voltar
        </a>
        <a href="{{ route('units.edit', $unit) }}" class="btn btn-primary">
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
                        <td>{{ $unit->name }}</td>
                    </tr>
                    <tr>
                        <th>Código:</th>
                        <td>{{ $unit->code ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Empresa:</th>
                        <td>{{ $unit->company->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Descrição:</th>
                        <td>{{ $unit->description ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            @if($unit->active)
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
                <h5 class="mb-0">Estatísticas</h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <h3 class="mb-0">{{ $unit->teams->count() }}</h3>
                            <small class="text-muted">Equipes</small>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <div class="border rounded p-3">
                            <h3 class="mb-0">{{ $unit->locations->count() }}</h3>
                            <small class="text-muted">Locais</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

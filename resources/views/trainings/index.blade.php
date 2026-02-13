@extends('layouts.app')

@section('title', 'Treinamentos')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h2 mb-0">
            <i class="bi bi-award-fill text-primary"></i> Treinamentos
        </h1>
        <p class="text-muted small mb-0">Gerenciar treinamentos e compliance</p>
    </div>
    <div>
        <a href="{{ route('trainings.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Novo Treinamento
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        @if(isset($trainings) && $trainings->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 30%">Nome do Treinamento</th>
                            <th style="width: 15%">Código</th>
                            <th style="width: 15%">Tipo</th>
                            <th style="width: 10%" class="text-center">Duração</th>
                            <th style="width: 10%" class="text-center">Nota Mínima</th>
                            <th style="width: 10%" class="text-center">Status</th>
                            <th style="width: 5%" class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trainings as $training)
                        <tr>
                            <td class="text-muted">#{{ $training->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning bg-opacity-10 rounded-circle p-2 me-2">
                                        <i class="bi bi-award-fill text-warning"></i>
                                    </div>
                                    <div>
                                        <strong>{{ $training->name }}</strong>
                                        @if($training->qualification)
                                            <br><small class="text-muted">
                                                <i class="bi bi-bookmark"></i> {{ $training->qualification->name }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($training->code)
                                    <span class="badge bg-secondary">{{ $training->code }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($training->type === 'online')
                                    <span class="badge bg-info">
                                        <i class="bi bi-laptop"></i> Online
                                    </span>
                                @else
                                    <span class="badge bg-primary">
                                        <i class="bi bi-person-video3"></i> Presencial
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($training->duration_hours)
                                    <i class="bi bi-clock"></i> {{ $training->duration_hours }}h
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($training->passing_score)
                                    {{ $training->passing_score }}%
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($training->active)
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Ativo
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-x-circle"></i> Inativo
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('trainings.show', $training) }}" 
                                       class="btn btn-outline-info" 
                                       title="Visualizar">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('trainings.edit', $training) }}" 
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
                <i class="bi bi-award" style="font-size: 4rem; color: #dee2e6;"></i>
                <p class="mt-3 text-muted">Nenhum treinamento cadastrado ainda.</p>
                <a href="{{ route('trainings.create') }}" class="btn btn-primary mt-2">
                    <i class="bi bi-plus-circle"></i> Cadastrar Primeiro Treinamento
                </a>
            </div>
        @endif
    </div>
    
    @if(isset($trainings) && $trainings->hasPages())
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Mostrando {{ $trainings->firstItem() }} a {{ $trainings->lastItem() }} de {{ $trainings->total() }} treinamentos
                </div>
                <div>
                    {{ $trainings->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

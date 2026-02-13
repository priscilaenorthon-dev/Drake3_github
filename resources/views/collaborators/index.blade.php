@extends('layouts.app')

@section('title', 'Colaboradores')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h2 mb-0">
            <i class="bi bi-people-fill text-primary"></i> Colaboradores
        </h1>
        <p class="text-muted small mb-0">Gerenciar colaboradores do sistema</p>
    </div>
    <div>
        <a href="{{ route('collaborators.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Novo Colaborador
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        @if(isset($collaborators) && $collaborators->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 25%">Nome</th>
                            <th style="width: 15%">Matrícula</th>
                            <th style="width: 15%">Cargo</th>
                            <th style="width: 15%">Equipe</th>
                            <th style="width: 10%" class="text-center">Status</th>
                            <th style="width: 15%" class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($collaborators as $collaborator)
                        <tr>
                            <td class="text-muted">#{{ $collaborator->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                        <i class="bi bi-person-fill text-primary"></i>
                                    </div>
                                    <div>
                                        <strong>{{ $collaborator->full_name }}</strong>
                                        @if($collaborator->email)
                                            <br><small class="text-muted">
                                                <i class="bi bi-envelope"></i> {{ $collaborator->email }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($collaborator->employee_number)
                                    <span class="badge bg-secondary">{{ $collaborator->employee_number }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($collaborator->position)
                                    <i class="bi bi-briefcase"></i> {{ $collaborator->position->name }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($collaborator->team)
                                    <i class="bi bi-people"></i> {{ $collaborator->team->name }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($collaborator->status === 'active')
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Ativo
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-x-circle"></i> {{ ucfirst($collaborator->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('collaborators.show', $collaborator) }}" 
                                       class="btn btn-outline-info" 
                                       title="Visualizar">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('collaborators.edit', $collaborator) }}" 
                                       class="btn btn-outline-warning"
                                       title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-outline-danger" 
                                            title="Excluir"
                                            onclick="if(confirm('Tem certeza que deseja excluir este colaborador?')) { document.getElementById('delete-form-{{ $collaborator->id }}').submit(); }">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $collaborator->id }}" 
                                      action="{{ route('collaborators.destroy', $collaborator) }}" 
                                      method="POST" 
                                      class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-people" style="font-size: 4rem; color: #dee2e6;"></i>
                <p class="mt-3 text-muted">Nenhum colaborador cadastrado ainda.</p>
                <a href="{{ route('collaborators.create') }}" class="btn btn-primary mt-2">
                    <i class="bi bi-plus-circle"></i> Cadastrar Primeiro Colaborador
                </a>
            </div>
        @endif
    </div>
    
    @if(isset($collaborators) && $collaborators->hasPages())
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Mostrando {{ $collaborators->firstItem() }} a {{ $collaborators->lastItem() }} de {{ $collaborators->total() }} colaboradores
                </div>
                <div>
                    {{ $collaborators->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

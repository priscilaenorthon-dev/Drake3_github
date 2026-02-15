@extends('layouts.app')

@section('title', 'Cargos')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h2 mb-0">
            <i class="bi bi-briefcase-fill text-primary"></i> Cargos
        </h1>
        <p class="text-muted small mb-0">Gerenciar cargos e posições</p>
    </div>
    <div>
        <a href="{{ route('positions.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Novo Cargo
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        @if($positions->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 30%">Nome</th>
                            <th style="width: 10%">Código</th>
                            <th style="width: 15%">Nível</th>
                            <th style="width: 25%">Descrição</th>
                            <th style="width: 10%" class="text-center">Status</th>
                            <th style="width: 10%" class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($positions as $position)
                        <tr>
                            <td class="text-muted">#{{ $position->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                        <i class="bi bi-briefcase-fill text-primary"></i>
                                    </div>
                                    <div>
                                        <strong>{{ $position->name }}</strong>
                                        @if($position->collaborators_count > 0)
                                            <br><small class="text-muted">{{ $position->collaborators_count }} colaborador(es)</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($position->code)
                                    <span class="badge bg-secondary">{{ $position->code }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($position->level)
                                    <span class="badge bg-info">{{ $position->level }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-muted small">
                                {{ Str::limit($position->description ?? '-', 50) }}
                            </td>
                            <td class="text-center">
                                @if($position->active)
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
                                <div class="btn-group" role="group">
                                    <a href="{{ route('positions.show', $position) }}" class="btn btn-sm btn-outline-primary" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('positions.edit', $position) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('positions.destroy', $position) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Tem certeza que deseja excluir este cargo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-briefcase-fill text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-3">Nenhum cargo cadastrado</h4>
                <p class="text-muted">Clique no botão acima para cadastrar o primeiro cargo.</p>
            </div>
        @endif
    </div>
    @if($positions->hasPages())
        <div class="card-footer">
            {{ $positions->links() }}
        </div>
    @endif
</div>
@endsection

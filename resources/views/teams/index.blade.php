@extends('layouts.app')

@section('title', 'Equipes')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h2 mb-0">
            <i class="bi bi-people text-primary"></i> Equipes
        </h1>
        <p class="text-muted small mb-0">Gerenciar equipes de trabalho</p>
    </div>
    <div>
        <a href="{{ route('teams.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nova Equipe
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        @if($teams->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 25%">Nome</th>
                            <th style="width: 10%">Código</th>
                            <th style="width: 20%">Unidade</th>
                            <th style="width: 20%">Líder</th>
                            <th style="width: 10%" class="text-center">Status</th>
                            <th style="width: 10%" class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teams as $team)
                        <tr>
                            <td class="text-muted">#{{ $team->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                        <i class="bi bi-people text-primary"></i>
                                    </div>
                                    <div>
                                        <strong>{{ $team->name }}</strong>
                                        @if($team->description)
                                            <br><small class="text-muted">{{ Str::limit($team->description, 30) }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($team->code)
                                    <span class="badge bg-secondary">{{ $team->code }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <i class="bi bi-geo-alt-fill"></i> {{ $team->unit->name ?? '-' }}
                            </td>
                            <td>
                                @if($team->leader)
                                    <i class="bi bi-person-badge"></i> {{ $team->leader->name }}
                                @else
                                    <span class="text-muted">Sem líder</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($team->active)
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
                                    <a href="{{ route('teams.show', $team) }}" class="btn btn-sm btn-outline-primary" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('teams.edit', $team) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('teams.destroy', $team) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Tem certeza que deseja excluir esta equipe?');">
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
                <i class="bi bi-people text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-3">Nenhuma equipe cadastrada</h4>
                <p class="text-muted">Clique no botão acima para cadastrar a primeira equipe.</p>
            </div>
        @endif
    </div>
    @if($teams->hasPages())
        <div class="card-footer">
            {{ $teams->links() }}
        </div>
    @endif
</div>
@endsection

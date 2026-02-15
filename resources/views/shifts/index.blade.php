@extends('layouts.app')

@section('title', 'Turnos')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h2 mb-0">
            <i class="bi bi-clock-fill text-primary"></i> Turnos
        </h1>
        <p class="text-muted small mb-0">Gerenciar turnos de trabalho</p>
    </div>
    <div>
        <a href="{{ route('shifts.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Novo Turno
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        @if($shifts->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 25%">Nome</th>
                            <th style="width: 10%">Código</th>
                            <th style="width: 15%">Início</th>
                            <th style="width: 15%">Fim</th>
                            <th style="width: 10%">Duração</th>
                            <th style="width: 10%" class="text-center">Status</th>
                            <th style="width: 10%" class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shifts as $shift)
                        <tr>
                            <td class="text-muted">#{{ $shift->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                        <i class="bi bi-clock-fill text-primary"></i>
                                    </div>
                                    <div>
                                        <strong>{{ $shift->name }}</strong>
                                        @if($shift->type)
                                            <br><small class="text-muted">{{ ucfirst($shift->type) }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($shift->code)
                                    <span class="badge bg-secondary">{{ $shift->code }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <i class="bi bi-clock"></i> {{ $shift->start_time }}
                            </td>
                            <td>
                                <i class="bi bi-clock"></i> {{ $shift->end_time }}
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $shift->duration_hours }}h</span>
                            </td>
                            <td class="text-center">
                                @if($shift->active)
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
                                    <a href="{{ route('shifts.show', $shift) }}" class="btn btn-sm btn-outline-primary" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('shifts.edit', $shift) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('shifts.destroy', $shift) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Tem certeza que deseja excluir este turno?');">
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
                <i class="bi bi-clock-fill text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-3">Nenhum turno cadastrado</h4>
                <p class="text-muted">Clique no botão acima para cadastrar o primeiro turno.</p>
            </div>
        @endif
    </div>
    @if($shifts->hasPages())
        <div class="card-footer">
            {{ $shifts->links() }}
        </div>
    @endif
</div>
@endsection

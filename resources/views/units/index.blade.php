@extends('layouts.app')

@section('title', 'Unidades')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h2 mb-0">
            <i class="bi bi-geo-alt-fill text-primary"></i> Unidades
        </h1>
        <p class="text-muted small mb-0">Gerenciar unidades organizacionais</p>
    </div>
    <div>
        <a href="{{ route('units.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nova Unidade
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        @if($units->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 30%">Nome</th>
                            <th style="width: 10%">Código</th>
                            <th style="width: 25%">Empresa</th>
                            <th style="width: 20%">Descrição</th>
                            <th style="width: 10%" class="text-center">Status</th>
                            <th style="width: 10%" class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($units as $unit)
                        <tr>
                            <td class="text-muted">#{{ $unit->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                        <i class="bi bi-geo-alt-fill text-primary"></i>
                                    </div>
                                    <strong>{{ $unit->name }}</strong>
                                </div>
                            </td>
                            <td>
                                @if($unit->code)
                                    <span class="badge bg-secondary">{{ $unit->code }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <i class="bi bi-building"></i> {{ $unit->company->name ?? '-' }}
                            </td>
                            <td class="text-muted small">
                                {{ Str::limit($unit->description ?? '-', 50) }}
                            </td>
                            <td class="text-center">
                                @if($unit->active)
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
                                    <a href="{{ route('units.show', $unit) }}" class="btn btn-sm btn-outline-primary" title="Ver">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('units.edit', $unit) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('units.destroy', $unit) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('Tem certeza que deseja excluir esta unidade?');">
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
                <i class="bi bi-geo-alt-fill text-muted" style="font-size: 4rem;"></i>
                <h4 class="mt-3">Nenhuma unidade cadastrada</h4>
                <p class="text-muted">Clique no botão acima para cadastrar a primeira unidade.</p>
            </div>
        @endif
    </div>
    @if($units->hasPages())
        <div class="card-footer">
            {{ $units->links() }}
        </div>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('title', 'Empresas')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1 class="h2 mb-0">
            <i class="bi bi-building text-primary"></i> Empresas
        </h1>
        <p class="text-muted small mb-0">Gerenciar empresas cadastradas no sistema</p>
    </div>
    <div>
        <a href="{{ route('companies.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nova Empresa
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        @if($companies->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 25%">Nome</th>
                            <th style="width: 15%">CNPJ</th>
                            <th style="width: 20%">E-mail</th>
                            <th style="width: 15%">Telefone</th>
                            <th style="width: 10%" class="text-center">Status</th>
                            <th style="width: 10%" class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                        <tr>
                            <td class="text-muted">#{{ $company->id }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2">
                                        <i class="bi bi-building-fill text-primary"></i>
                                    </div>
                                    <div>
                                        <strong>{{ $company->name }}</strong>
                                        @if($company->legal_name)
                                            <br><small class="text-muted">{{ $company->legal_name }}</small>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="text-muted">
                                @if($company->tax_id)
                                    <i class="bi bi-file-text"></i> {{ $company->tax_id }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($company->email)
                                    <i class="bi bi-envelope"></i> 
                                    <a href="mailto:{{ $company->email }}" class="text-decoration-none">
                                        {{ $company->email }}
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($company->phone)
                                    <i class="bi bi-telephone"></i> {{ $company->phone }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($company->active)
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
                                    <a href="{{ route('companies.show', $company) }}" 
                                       class="btn btn-outline-info" 
                                       title="Visualizar">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('companies.edit', $company) }}" 
                                       class="btn btn-outline-warning"
                                       title="Editar">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-outline-danger" 
                                            title="Excluir"
                                            onclick="if(confirm('Tem certeza que deseja excluir esta empresa?')) { document.getElementById('delete-form-{{ $company->id }}').submit(); }">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <form id="delete-form-{{ $company->id }}" 
                                      action="{{ route('companies.destroy', $company) }}" 
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
                <i class="bi bi-building" style="font-size: 4rem; color: #dee2e6;"></i>
                <p class="mt-3 text-muted">Nenhuma empresa cadastrada ainda.</p>
                <a href="{{ route('companies.create') }}" class="btn btn-primary mt-2">
                    <i class="bi bi-plus-circle"></i> Cadastrar Primeira Empresa
                </a>
            </div>
        @endif
    </div>
    
    @if($companies->hasPages())
        <div class="card-footer bg-light">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Mostrando {{ $companies->firstItem() }} a {{ $companies->lastItem() }} de {{ $companies->total() }} empresas
                </div>
                <div>
                    {{ $companies->links() }}
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Quick Stats -->
@if($companies->count() > 0)
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Empresas Ativas</h6>
                        <h3 class="mb-0 text-success">{{ $companies->where('active', true)->count() }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded">
                        <i class="bi bi-check-circle text-success" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-secondary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Empresas Inativas</h6>
                        <h3 class="mb-0 text-secondary">{{ $companies->where('active', false)->count() }}</h3>
                    </div>
                    <div class="bg-secondary bg-opacity-10 p-3 rounded">
                        <i class="bi bi-x-circle text-secondary" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total de Empresas</h6>
                        <h3 class="mb-0 text-primary">{{ $companies->total() }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                        <i class="bi bi-building-fill text-primary" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

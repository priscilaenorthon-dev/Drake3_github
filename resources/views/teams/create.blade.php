@extends('layouts.app')

@section('title', 'Nova Equipe')

@section('content')
<div class="page-header">
    <h1 class="h2 mb-0">
        <i class="bi bi-people text-primary"></i> Nova Equipe
    </h1>
    <p class="text-muted small mb-0">Cadastrar nova equipe de trabalho</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('teams.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="unit_id" class="form-label">Unidade <span class="text-danger">*</span></label>
                    <select name="unit_id" id="unit_id" class="form-select @error('unit_id') is-invalid @enderror" required>
                        <option value="">Selecione uma unidade</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                                {{ $unit->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('unit_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="code" class="form-label">Código</label>
                    <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}">
                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="leader_id" class="form-label">Líder da Equipe</label>
                <select name="leader_id" id="leader_id" class="form-select @error('leader_id') is-invalid @enderror">
                    <option value="">Sem líder</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('leader_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('leader_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <div class="form-check">
                    <input type="hidden" name="active" value="0">
                    <input type="checkbox" name="active" id="active" class="form-check-input" value="1" {{ old('active', true) ? 'checked' : '' }}>
                    <label for="active" class="form-check-label">Ativo</label>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('teams.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Salvar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

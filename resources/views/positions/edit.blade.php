@extends('layouts.app')

@section('title', 'Editar Cargo')

@section('content')
<div class="page-header">
    <h1 class="h2 mb-0">
        <i class="bi bi-briefcase-fill text-primary"></i> Editar Cargo
    </h1>
    <p class="text-muted small mb-0">{{ $position->name }}</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('positions.update', $position) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $position->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="code" class="form-label">Código</label>
                    <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $position->code) }}">
                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="level" class="form-label">Nível</label>
                <input type="text" name="level" id="level" class="form-control @error('level') is-invalid @enderror" value="{{ old('level', $position->level) }}" placeholder="Ex: Júnior, Pleno, Sênior">
                @error('level')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror">{{ old('description', $position->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <div class="form-check">
                    <input type="hidden" name="active" value="0">
                    <input type="checkbox" name="active" id="active" class="form-check-input" value="1" {{ old('active', $position->active) ? 'checked' : '' }}>
                    <label for="active" class="form-check-label">Ativo</label>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('positions.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Cancelar
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Atualizar
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

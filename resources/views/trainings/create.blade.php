@extends('layouts.app')

@section('title', 'Novo Treinamento')

@section('content')
<div class="page-header">
    <h1 class="h2 mb-0">
        <i class="bi bi-award-fill text-primary"></i> Novo Treinamento
    </h1>
    <p class="text-muted small mb-0">Cadastrar novo treinamento</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('trainings.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nome <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
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
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="qualification_id" class="form-label">Qualificação</label>
                    <select name="qualification_id" id="qualification_id" class="form-select @error('qualification_id') is-invalid @enderror">
                        <option value="">Nenhuma</option>
                        @foreach($qualifications as $qualification)
                            <option value="{{ $qualification->id }}" {{ old('qualification_id') == $qualification->id ? 'selected' : '' }}>
                                {{ $qualification->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('qualification_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="type" class="form-label">Tipo <span class="text-danger">*</span></label>
                    <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                        <option value="">Selecione</option>
                        <option value="online" {{ old('type') == 'online' ? 'selected' : '' }}>Online</option>
                        <option value="in_person" {{ old('type') == 'in_person' ? 'selected' : '' }}>Presencial</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="duration_hours" class="form-label">Duração (horas) <span class="text-danger">*</span></label>
                    <input type="number" name="duration_hours" id="duration_hours" step="0.5" class="form-control @error('duration_hours') is-invalid @enderror" value="{{ old('duration_hours') }}" required>
                    @error('duration_hours')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            
            <div class="mb-3">
                <label for="passing_score" class="form-label">Nota Mínima (%)</label>
                <input type="number" name="passing_score" id="passing_score" min="0" max="100" step="0.01" class="form-control @error('passing_score') is-invalid @enderror" value="{{ old('passing_score') }}" placeholder="Ex: 70">
                @error('passing_score')
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
                    <input type="checkbox" name="active" id="active" class="form-check-input" value="1" {{ old('active', 1) == 1 ? 'checked' : '' }}>
                    <label for="active" class="form-check-label">Ativo</label>
                </div>
            </div>
            
            <div class="d-flex justify-content-between">
                <a href="{{ route('trainings.index') }}" class="btn btn-secondary">
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

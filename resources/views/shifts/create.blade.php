@extends('layouts.app')

@section('title', 'Novo Turno')

@section('content')
<div class="page-header">
    <h1 class="h2 mb-0">
        <i class="bi bi-clock-fill text-primary"></i> Novo Turno
    </h1>
    <p class="text-muted small mb-0">Cadastrar novo turno de trabalho</p>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('shifts.store') }}" method="POST">
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
                    <label for="start_time" class="form-label">Horário de Início <span class="text-danger">*</span></label>
                    <input type="time" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" value="{{ old('start_time') }}" required>
                    @error('start_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="end_time" class="form-label">Horário de Término <span class="text-danger">*</span></label>
                    <input type="time" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror" value="{{ old('end_time') }}" required>
                    @error('end_time')
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
                <label for="type" class="form-label">Tipo</label>
                <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type') }}" placeholder="Ex: Dia, Noite, Rotativo">
                @error('type')
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
                <a href="{{ route('shifts.index') }}" class="btn btn-secondary">
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

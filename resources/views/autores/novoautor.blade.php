@extends('layouts.app')

@section('title', 'Novo autor')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Novo autor</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('novoautor') }}" method="POST">
                    @csrf
                    <input type="hidden" name="codAu" value="{{ old('codAu', $autor->codAu ?? '') }}">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome"
                            class="form-control @error('nome') is-invalid @enderror"
                            value="{{ old('nome', $autor->nome ?? '') }}" maxlength="40" required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{ route('autores') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection

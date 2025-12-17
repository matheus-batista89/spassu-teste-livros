@extends('layouts.app')

@section('title', 'Novo assunto')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Novo assunto</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('novoassunto') }}" method="POST">
                    @csrf
                    <input type="hidden" name="codAs" value="{{ old('codAs', $assunto->codAs ?? '') }}">
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" name="descricao" id="descricao"
                            class="form-control @error('descricao') is-invalid @enderror" maxlength="20"
                            value="{{ old('descricao', $assunto->descricao ?? '') }}" required>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{ route('assuntos') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection

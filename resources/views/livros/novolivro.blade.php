@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Novo livro</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('novolivro') }}" method="POST">
                    @csrf
                    <input type="hidden" name="codL" value="{{ old('codL', $livro->codL ?? '') }}">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="titulo" class="form-label">Título</label>
                            <input type="text" name="titulo" id="titulo" class="form-control"
                                value="{{ old('titulo', $livro->titulo ?? '') }}" maxlength="40" required>
                        </div>

                        <div class="col-md-6">
                            <label for="editora" class="form-label">Editora</label>
                            <input type="text" name="editora" id="editora" class="form-control"
                                value="{{ old('editora', $livro->editora ?? '') }}" maxlength="40" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <label for="edicao" class="form-label">Edição</label>
                            <input type="text" name="edicao" id="edicao" class="form-control"
                                value="{{ old('edicao', $livro->edicao ?? '') }}" required>
                        </div>

                        <div class="col-md-2">
                            <label for="valor" class="form-label">Valor (R$)</label>
                            <input type="text" name="valor" id="valor"
                                value="{{ old('valor', $livro->valor_formatado ?? '') }}"
                                class="form-control formato-dinheiro" required>
                        </div>

                        <div class="col-md-2">
                            <label for="anoPublicacao" class="form-label">Ano de Publicação</label>
                            <input type="text" name="anoPublicacao" id="anoPublicacao" class="form-control"
                                pattern="\d{1,4}" maxlength="4" title="Digite o ano de publicação"
                                value="{{ old('anoPublicacao', $livro->anoPublicacao ?? '') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="assuntos" class="form-label">Assuntos</label>
                            @php
                                $assuntosSelecionados = old(
                                    'assuntos',
                                    !empty($livro) ? $livro->assuntos->pluck('codAs')->toArray() : [],
                                );
                            @endphp
                            <select name="assuntos[]" id="assuntos" class="form-select select2" multiple required>
                                @foreach ($assuntos as $assunto)
                                    <option value="{{ $assunto->codAs }}"
                                        @if (in_array($assunto->codAs, $assuntosSelecionados)) selected @endif>
                                        {{ $assunto->descricao }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="autores" class="form-label">Autores</label>
                            <select name="autores[]" id="autores" class="form-select select2" multiple required>
                                @foreach ($autores as $autor)
                                    <option value="{{ $autor->codAu }}" @if (!empty($livro) && $livro->autores->contains($autor->codAu)) selected @endif>
                                        {{ $autor->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{ route('livros') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection

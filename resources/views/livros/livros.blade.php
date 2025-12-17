@extends('layouts.app')

@section('title', 'Listagem de livros')

@section('content')
    <h2 class="mb-4">Lista de Livros</h2>
    <a href="{{ route('novolivro', ['codL' => null]) }}" class="btn btn-primary btn-novo">
        Novo Livro
    </a>


    <table id="tabela-livros" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="width: 5%" scope="col">Código</th>
                <th style="width: 28%" scope="col">Título</th>
                <th style="width: 25%" scope="col">Autor</th>
                <th style="width: 10%" scope="col">Assunto</th>
                <th style="width: 5%" scope="col">Edição</th>
                <th style="width: 10%" scope="col">Editora</th>
                <th style="width: 5%" scope="col">Valor</th>
                <th style="width: 5%" scope="col">Ano de publicação</th>
                <th style="width: 7%" scope="col" class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($livros as $livro)
                <tr>
                    <td class="text-center align-middle">{{ $livro->codL }}</td>
                    <td>{{ $livro->titulo }}</td>
                    <td>{{ $livro->nomes_autores }}</td>
                    <td class="text-center align-middle">{{ $livro->nomes_assuntos }}</td>
                    <td class="text-center align-middle">{{ $livro->edicao }}</td>
                    <td class="text-center align-middle">{{ $livro->editora }}</td>
                    <td class="text-center align-middle">{{ $livro->valor_formatado }}</td>
                    <td class="text-center align-middle">{{ $livro->anoPublicacao }}</td>
                    <td class="text-center">
                        <a href="{{ route('novolivro') }}?codL={{ $livro->codL }}" class="btn btn-sm btn-outline-primary"
                            title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('deletarlivro') }}?codL={{ $livro->codL }}" method="POST"
                            style="display: inline-block;"
                            onsubmit="return confirm('Tem certeza que deseja excluir esse livro?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Excluir">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

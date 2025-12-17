@extends('layouts.app')

@section('title', 'Listagem de autores')

@section('content')
    <h2 class="mb-4">Lista de Autores</h2>
    <a href="{{ route('novoautor', ['codAu' => null]) }}" class="btn btn-primary btn-novo">
        Novo Autor
    </a>
    <table id="tabela-autores" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="width: 5%" scope="col">Código</th>
                <th scope="col">Nome</th>
                <th style="width: 7%" scope="col" class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($autores as $autor)
                <tr>
                    <td>{{ $autor->codAu }}</td>
                    <td>{{ $autor->nome }}</td>
                    <td class="text-center">
                        <a href="{{ route('novoautor') }}?codAu={{ $autor->codAu }}" class="btn btn-sm btn-outline-primary"
                            title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('deletarautor') }}?codAu={{ $autor->codAu }}" method="POST"
                            style="display: inline-block;"
                            onsubmit="return confirm('Tem certeza que deseja excluir esse autor?')">
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
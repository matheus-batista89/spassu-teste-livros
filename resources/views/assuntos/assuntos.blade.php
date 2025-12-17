@extends('layouts.app')

@section('title', 'Listagem de assuntos')

@section('content')
    <h2 class="mb-4">Lista de Assuntos</h2>
    <a href="{{ route('novoassunto', ['codAs' => null]) }}" class="btn btn-primary btn-novo">
        Novo Assunto
    </a>
    <table id="tabela-assuntos" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="width: 5%" scope="col">Código</th>
                <th scope="col">Descrição</th>
                <th style="width: 7%" scope="col" class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assuntos as $assunto)
                <tr>
                    <td>{{ $assunto->codAs }}</td>
                    <td>{{ $assunto->descricao }}</td>
                    <td class="text-center">
                        <a href="{{ route('novoassunto') }}?codAs={{ $assunto->codAs }}"
                            class="btn btn-sm btn-outline-primary" title="Editar">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <form action="{{ route('deletarassunto') }}?codAs={{ $assunto->codAs }}" method="POST"
                            style="display: inline-block;"
                            onsubmit="return confirm('Tem certeza que deseja excluir esse assunto?')">
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

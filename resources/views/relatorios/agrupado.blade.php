<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Relatório agrupado por Autor</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        .titulo-agrupador {
            margin-top: 3em;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Relatório Agrupado por Autor</h2>

        @forelse ($arLivros as $autor => $livros)
            <div class="card mb-4">
                <div class="card-header text-center fw-bold titulo-agrupador">
                    <b>{{ $autor }}</b>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center m-0">
                            <thead class="table-secondary">
                                <tr>
                                    <th style="width: 5%" scope="col">Código</th>
                                    <th scope="col">Título</th>
                                    <th style="width: 10%" scope="col">Assunto</th>
                                    <th style="width: 5%" scope="col">Edição</th>
                                    <th style="width: 10%" scope="col">Editora</th>
                                    <th style="width: 5%" scope="col">Valor (R$)</th>
                                    <th style="width: 5%" scope="col">Ano de publicação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($livros as $livro)
                                    <tr>
                                        <td class="central">{{ $livro['codL'] }}</td>
                                        <td>{{ $livro['titulo'] }}</td>
                                        <td>{{ $livro['descricao'] }}</td>
                                        <td class="central">{{ $livro['editora'] }}</td>
                                        <td class="central">{{ $livro['edicao'] }}</td>
                                        <td class="central">{{ $livro['anoPublicacao'] }}</td>
                                        <td class="central">R$ {{ number_format($livro['valor'], 2, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Nenhum dado encontrado na view.</p>
        @endforelse
</body>

</html>

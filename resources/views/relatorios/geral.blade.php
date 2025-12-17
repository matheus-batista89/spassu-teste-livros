<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Relatório geral de livros</title>
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
    </style>
</head>

<body>
    @if (count($livros) > 0)
        <div class="card mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center m-0">
                        <thead class="table-secondary">
                            <tr>
                                <th scope="col">Autor</th>
                                <th scope="col">Quantidade de livros</th>
                                <th scope="col">Títulos</th>
                                <th scope="col">Valor dos livros</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($livros as $livro)
                                <tr>
                                    <td>{{ $livro['autor_nome'] }}</td>
                                    <td>{{ $livro['total_livros'] }}</td>
                                    <td class="central">{{ $livro['titulos'] }}</td>
                                    <td class="central">R$ {{ number_format($livro['soma_valores'], 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <p class="text-center">Nenhum dado encontrado na view.</p>
    @endif
</body>

</html>

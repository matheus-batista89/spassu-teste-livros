<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        $driver = DB::getDriverName();

        if ($driver == 'pgsql') {
            DB::statement("
            CREATE VIEW view_livros_resumo AS
                SELECT 
                    autor.codAu,
                    autor.nome AS autor_nome,
                    COUNT(DISTINCT livro.codL) AS total_livros,
                    SUM(livro.valor) AS soma_valores,
                    STRING_AGG(DISTINCT livro.titulo, ', ') AS titulos,
                    STRING_AGG(DISTINCT assunto.descricao, ', ') AS assuntos
                FROM livro
                JOIN livro_autor ON livro.codL = livro_autor.livro_codL
                JOIN autor ON autor.codAu = livro_autor.autor_codAu
                LEFT JOIN livro_assunto ON livro.codL = livro_assunto.livro_codL
                LEFT JOIN assunto ON assunto.codAs = livro_assunto.assunto_codAs
                GROUP BY autor.codAu, autor.nome;
        ");
        } else {
            DB::statement("
                CREATE VIEW view_livros_resumo AS
                SELECT 
                    a.codAu,
                    a.nome AS autor_nome,
                    COUNT(DISTINCT l.codL) AS total_livros,
                    SUM(l.valor) AS soma_valores,
                    (
                        SELECT GROUP_CONCAT(DISTINCT l2.titulo SEPARATOR ', ')
                        FROM livro l2
                        JOIN livro_autor la2 ON la2.livro_codL = l2.codL
                        WHERE la2.autor_codAu = a.codAu AND l2.titulo != ''
                    ) AS titulos,
                    (
                        SELECT GROUP_CONCAT(DISTINCT as2.descricao SEPARATOR ', ')
                        FROM livro l2
                        JOIN livro_autor la2 ON la2.livro_codL = l2.codL
                        LEFT JOIN livro_assunto las2 ON las2.livro_codL = l2.codL
                        LEFT JOIN assunto as2 ON as2.codAs = las2.assunto_codAs
                        WHERE la2.autor_codAu = a.codAu AND as2.descricao IS NOT NULL
                    ) AS assuntos
                FROM autor a
                JOIN livro_autor la ON la.autor_codAu = a.codAu
                JOIN livro l ON l.codL = la.livro_codL
                GROUP BY a.codAu, a.nome;
            ");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS view_livros_resumo");
    }
};

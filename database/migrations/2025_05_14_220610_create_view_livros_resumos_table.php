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
                    GROUP_CONCAT(DISTINCT livro.titulo SEPARATOR ', ') AS titulos
                FROM livro
                JOIN livro_autor ON livro.codL = livro_autor.livro_codL
                JOIN autor ON autor.codAu = livro_autor.autor_codAu
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
                        SELECT GROUP_CONCAT(DISTINCT l2.titulo, ', ')
                        FROM livro l2
                        JOIN livro_autor la2 ON la2.livro_codL = l2.codL
                        WHERE la2.autor_codAu = a.codAu AND l2.titulo != ''
                    ) AS titulos
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

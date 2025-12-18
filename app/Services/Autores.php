<?php

namespace App\Services;

use App\DTO\AutorDTO;
use App\Models\Autor as ModelAutor;
use Exception;
use Illuminate\Support\Facades\DB;

class Autores
{
    /**
     * Método responsável por buscar um autor com base no codAu recebido
     * @param int $codAu Identificador único do autor
     */
    public function getById(int $codAu)
    {
        return ModelAutor::where('codAu', $codAu)->firstOrFail();
    }

    /**
     * Método responsável por buscar os autores com base no filtro recebido
     * @param array $filtros Filtros para buscar um autor expecifico
     */
    public function get($filtros = [])
    {
        $assuntos = ModelAutor::when($filtros, function ($query, $busca) {
            return $query->where('nome', 'like', '%' . $busca . '%');
        })
            ->orderBy('codAu')
            ->paginate()
            ->withQueryString();

        return $assuntos;
    }

    /**
     * Método responsável por salvar um autor 
     * @param AutorDTO $autorDTO Dados do autor que serão salvos
     */
    public function save(AutorDTO $autorDTO)
    {
        DB::beginTransaction();
        try {
            if (!empty($autorDTO->codAu)) {
                $autor = $this->getById($autorDTO->codAu);
                $autor->update($autorDTO->toArray());
                DB::commit();
                return $autor;
            }

            $autor = ModelAutor::create($autorDTO->toArray());
            DB::commit();
            return $autor;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

     /**
     * Método responsável por deletar um autor
     * @param int $codAu Identificador único do autor
     */
    public function delete(int $codAu)
    {
        DB::beginTransaction();
        try {
            $autor = $this->getById($codAu);
            if ($autor->livros()->exists()) {
                throw new Exception('O autor esta vinculado a um ou mais livros.');
            }
            $autor->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

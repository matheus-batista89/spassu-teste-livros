<?php

namespace App\Services;

use App\DTO\AssuntoDTO;
use App\Models\Assunto as ModelAssuntos;
use Exception;
use Illuminate\Support\Facades\DB;

class Assuntos
{
    /**
     * Método responsável por buscar um assunto com base no codAs recebido
     * @param int $codAs Identificador único do assunto
     */
    public function getById(int $codAs)
    {
        return ModelAssuntos::where('codAs', $codAs)->firstOrFail();
    }

    /**
     * Método responsável por buscar os assuntos com base no filtro recebido
     * @param array $filtros FIltros para buscar um assunto expecifico
     */
    public function get($filtros = [])
    {
        $assuntos = ModelAssuntos::when($filtros, function ($query, $busca) {
            return $query->where('descricao', 'like', '%' . $busca . '%');
        })
            ->orderBy('codAs')
            ->paginate()
            ->withQueryString();

        return $assuntos;
    }

    /**
     * Método responsável por salvar um assunto 
     * @param AssuntoDTO $assuntoDTO Dados do assunto que serão salvos
     */
    public function save(AssuntoDTO $assuntoDTO)
    {
        DB::beginTransaction();
        try {
            if (!empty($assuntoDTO->codAs)) {
                $assunto = $this->getById($assuntoDTO->codAs);
                $assunto->update($assuntoDTO->toArray());
                DB::commit();
                return $assunto;
            }

            $assunto = ModelAssuntos::create($assuntoDTO->toArray());
            DB::commit();
            return $assunto;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Método responsável por deletar um assunto
     * @param int $codAs Identificador único do assunto
     */
    public function delete(int $codAs)
    {
        DB::beginTransaction();
        try {
            $assunto = $this->getById($codAs);
            if ($assunto->livros()->exists()) {
                throw new Exception('O assunto esta vinculado a um ou mais livros.');
            }
            $assunto->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}

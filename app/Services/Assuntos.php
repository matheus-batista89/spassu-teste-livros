<?php

namespace App\Services;

use App\Models\Assunto as ModelAssuntos;
use Exception;

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
     * @param array $dadosAssunto Dados do assunto que serão salvos
     */
    public function save(array $dadosAssunto)
    {
        if (!empty($dadosAssunto['codAs'])) {
            $assunto = $this->getById($dadosAssunto['codAs']);
            return $assunto->update($dadosAssunto);
        }

        return ModelAssuntos::create($dadosAssunto);
    }

    /**
     * Método responsável por deletar um assunto
     * @param int $codAs Identificador único do assunto
     */
    public function delete(int $codAs)
    {
        $assunto = $this->getById($codAs);
        if ($assunto->livros()->exists()) {
            throw new Exception('O assunto esta vinculado a um ou mais livros.');
        }
        return $assunto->delete();
    }
}

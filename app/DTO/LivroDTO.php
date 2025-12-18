<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LivroDTO
{
    public ?int $codL;
    public string $titulo;
    public string $editora;
    public int $edicao;
    public string $anoPublicacao;
    public float $valor;
    public array $autores;
    public array $assuntos;

    public function __construct(
        ?int $codL = null,
        string $titulo = '',
        string $editora = '',
        int $edicao = 0,
        string $anoPublicacao = '',
        float $valor = 0.0,
        array $autores = [],
        array $assuntos = []
    ) {
        $this->codL = $codL;
        $this->titulo = $titulo;
        $this->editora = $editora;
        $this->edicao = $edicao;
        $this->anoPublicacao = $anoPublicacao;
        $this->valor = $valor;
        $this->autores = $autores;
        $this->assuntos = $assuntos;
    }

    /**
     * Cria um DTO a partir de um Request validado
     */
    public static function fromRequest(Request $request): self
    {
        $rules = [
            'titulo' => 'required|string|max:40',
            'editora' => 'required|string|max:40',
            'edicao' => 'required|integer',
            'anoPublicacao' => 'required|integer|between:0,' . date('Y'),
            'autores' => 'required|array',
            'assuntos' => 'required|array',
            'assuntos.*' => 'integer',
            'valor' => 'required|string|max:13'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $validated = $validator->validated();

        // Converte valor de string para float
        $valor = (float)str_replace(['.', ','], ['', '.'], $validated['valor']);

        return new self(
            codL: $request->input('codL') ? (int)$request->input('codL') : null,
            titulo: $validated['titulo'],
            editora: $validated['editora'],
            edicao: (int)$validated['edicao'],
            anoPublicacao: $validated['anoPublicacao'],
            valor: $valor,
            autores: $validated['autores'],
            assuntos: $validated['assuntos']
        );
    }

    /**
     * Converte o DTO para array
     */
    public function toArray(): array
    {
        return [
            'codL' => $this->codL,
            'titulo' => $this->titulo,
            'editora' => $this->editora,
            'edicao' => $this->edicao,
            'anoPublicacao' => $this->anoPublicacao,
            'valor' => $this->valor,
            'autores' => $this->autores,
            'assuntos' => $this->assuntos,
        ];
    }
}


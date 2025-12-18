<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AssuntoDTO
{
    public ?int $codAs;
    public string $descricao;

    public function __construct(?int $codAs = null, string $descricao = '')
    {
        $this->codAs = $codAs;
        $this->descricao = $descricao;
    }

    /**
     * Cria um DTO a partir de um Request validado
     */
    public static function fromRequest(Request $request): self
    {
        $rules = [
            'descricao' => 'required|string|max:20',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $validated = $validator->validated();

        return new self(
            codAs: $request->input('codAs') ? (int)$request->input('codAs') : null,
            descricao: $validated['descricao']
        );
    }

    /**
     * Converte o DTO para array
     */
    public function toArray(): array
    {
        return [
            'codAs' => $this->codAs,
            'descricao' => $this->descricao,
        ];
    }
}


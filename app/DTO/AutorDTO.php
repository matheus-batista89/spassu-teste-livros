<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AutorDTO
{
    public ?int $codAu;
    public string $nome;

    public function __construct(?int $codAu = null, string $nome = '')
    {
        $this->codAu = $codAu;
        $this->nome = $nome;
    }

    /**
     * Cria um DTO a partir de um Request validado
     */
    public static function fromRequest(Request $request): self
    {
        $rules = [
            'nome' => 'required|string|max:40',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $validated = $validator->validated();

        return new self(
            codAu: $request->input('codAu') ? (int)$request->input('codAu') : null,
            nome: $validated['nome']
        );
    }

    /**
     * Converte o DTO para array
     */
    public function toArray(): array
    {
        return [
            'codAu' => $this->codAu,
            'nome' => $this->nome,
        ];
    }
}


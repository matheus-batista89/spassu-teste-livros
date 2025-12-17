<?php

namespace Database\Factories;

use App\Models\Assunto;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssuntoFactory extends Factory
{
    protected $model = Assunto::class;

    public function definition(): array
    {
        return [
            'descricao' => $this->faker->sentence(3),
        ];
    }
}

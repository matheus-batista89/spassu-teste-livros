<?php

namespace Database\Factories;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Factories\Factory;

class LivroFactory extends Factory
{
    protected $model = Livro::class;

    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence,
            'editora' => $this->faker->company,
            'edicao' => $this->faker->randomDigitNotZero(),
            'anoPublicacao' => $this->faker->year(),
            'valor' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}

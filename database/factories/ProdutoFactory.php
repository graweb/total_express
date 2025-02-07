<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->word(),
            'preco' => fake()->randomFloat(2, 10, 1000),
            'criado_em' => fake()->dateTimeBetween('-2 days', 'now'),
        ];
    }
}

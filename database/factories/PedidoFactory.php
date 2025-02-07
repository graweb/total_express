<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedido>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usuario_id' => User::inRandomOrder()->first()->id,
            'status' => fake()->randomElement(['iniciado', 'finalizado', 'cancelado', 'expirado', 'pendente']),
            'total' => fake()->randomFloat(2, 10, 1000),
            'criado_em' => fake()->dateTimeBetween('-2 days', 'now'),
        ];
    }
}

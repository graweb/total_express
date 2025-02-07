<?php

namespace Database\Factories;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItensDosPedidos>
 */
class ItensDosPedidosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pedido_id' => Pedido::inRandomOrder()->first()->id,
            'produto_id' => Produto::inRandomOrder()->first()->id,
            'quantidade' => fake()->randomNumber(3),
            'subtotal' => fake()->randomFloat(2, 10, 1000),
        ];
    }
}

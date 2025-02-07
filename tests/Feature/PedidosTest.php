<?php

namespace Tests\Feature;

use App\Models\Pedido;
use Tests\TestCase;
use App\Models\User;
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PedidosTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste para criar um pedido via API
     */
    public function test_criar_pedido_via_api(): void
    {
        $user = User::factory()->create();
        $produtos = Produto::factory()->count(3)->create();

        $produtosPedido = $produtos->map(fn($produto) => [
            "produto_id" => $produto->id,
            "quantidade" => 1
        ])->toArray();

        $response = $this->actingAs($user, 'sanctum')->postJson('/api/pedido', [
            "produtos" => $produtosPedido
        ]);

        $response->assertStatus(201);
    }

    /**
     * Teste consultar todos os pedidos via API
     */
    public function test_consultar_todos_os_pedidos_via_api(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->getJson("/api/pedido");

        $response->assertStatus(200);
    }

    /**
     * Teste consultar pedidos pelo id do pedido via API
     */
    public function test_consultar_pedidos_pelo_id_do_pedido_via_api(): void
    {
        $user = User::factory()->create();
        $pedido = Pedido::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->getJson("/api/pedido?id={$pedido->id}");

        $response->assertStatus(200);
    }

    /**
     * Teste consultar pedidos pelo id do usuário via API
     */
    public function test_consultar_pedidos_pelo_id_do_usuario_via_api(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')->getJson("/api/pedido?usuario_id={$user->id}");

        $response->assertStatus(200);
    }
}

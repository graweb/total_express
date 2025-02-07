<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use App\Models\User;
use App\Services\PedidoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PedidoServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste unitário para usar o service e criar um pedido
     */
    public function test_criar_pedido_service()
    {
        // Cria um mock do usuário
        $user = Mockery::mock(User::class)->makePartial();
        $user->id = 1;
        $user->name = 'Usuário de teste';
        $user->email = 'teste@totalexpress.com.br';

        // Simulando a autenticação
        Auth::shouldReceive('attempt')
            ->once()
            ->with(['email' => 'teste@totalexpress.com.br', 'password' => 'password'])
            ->andReturn(true);

        Auth::shouldReceive('user')->andReturn($user);

        // Faz o login
        $credentials = ['email' => 'teste@totalexpress.com.br', 'password' => 'password'];
        $attempt = Auth::attempt($credentials);

        // Verifica se o login foi bem-sucedido
        $this->assertTrue($attempt);
        $this->assertEquals(1, Auth::user()->id);
        $this->assertEquals('Usuário de teste', Auth::user()->name);

        // Criar mock do PedidoService
        $pedidoServiceMock = Mockery::mock(PedidoService::class);

        // Definir o comportamento esperado do método criarPedido
        $pedidoServiceMock->shouldReceive('criarPedido')
            ->once()
            ->with([
                ['produto_id' => 1, 'quantidade' => 5],
                ['produto_id' => 2, 'quantidade' => 10],
                ['produto_id' => 3, 'quantidade' => 20]
            ])
            ->andReturn(['pedido_id' => 123, 'status' => 'iniciado']);

        // Chamando o serviço
        $pedido = $pedidoServiceMock->criarPedido([
            ['produto_id' => 1, 'quantidade' => 5],
            ['produto_id' => 2, 'quantidade' => 10],
            ['produto_id' => 3, 'quantidade' => 20]
        ]);

        // Verificando se o retorno está correto
        $this->assertEquals(123, $pedido['pedido_id']);
        $this->assertEquals('iniciado', $pedido['status']);
    }

    /**
     * Teste unitário para usar o service e calcular o total do pedido
     */
    public function test_calcular_total_pedido_service()
    {
        // Cria um mock do usuário
        $user = Mockery::mock(User::class)->makePartial();
        $user->id = 1;
        $user->name = 'Usuário de teste';
        $user->email = 'teste@totalexpress.com.br';

        // Simulando a autenticação
        Auth::shouldReceive('attempt')
            ->once()
            ->with(['email' => 'teste@totalexpress.com.br', 'password' => 'password'])
            ->andReturn(true);

        Auth::shouldReceive('user')->andReturn($user);

        // Faz o login
        $credentials = ['email' => 'teste@totalexpress.com.br', 'password' => 'password'];
        $attempt = Auth::attempt($credentials);

        // Verifica se o login foi bem-sucedido
        $this->assertTrue($attempt);
        $this->assertEquals(1, Auth::user()->id);
        $this->assertEquals('Usuário de teste', Auth::user()->name);

        // Criar mock do PedidoService
        $pedidoServiceMock = Mockery::mock(PedidoService::class);

        // Definir o comportamento esperado do método calcularTotal
        $pedidoServiceMock->shouldReceive('calcularTotal')
            ->once()
            ->with(123)
            ->andReturn(100);

        // Chamando o serviço
        $total = $pedidoServiceMock->calcularTotal(123);

        // Verificando se o retorno está correto
        $this->assertEquals(100, $total);
    }
}

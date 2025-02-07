<?php

namespace App\Services;

use App\Models\ItensDosPedidos;
use App\Models\Pedido;
use App\Models\Produto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PedidoService
{
    /**
     * Cria o pedido
     */
    public static function criarPedido(array $pedido)
    {
        $usuario = Auth::user();

        $novoPedido = Pedido::create([
            'usuario_id' => $usuario->id,
            'status' => 'iniciado',
            'total' => 0,
            'criado_em' => Carbon::now('America/Sao_Paulo'),
        ]);

        foreach ($pedido['produtos'] as $produtosPedido) {
            $produto = Produto::find($produtosPedido['produto_id']);

            $novoPedido->produto()->attach($produto->id, [
                'quantidade' => $produtosPedido['quantidade'],
                'subtotal' => $produto->preco * $produtosPedido['quantidade'],
            ]);
        }

        $total = self::calcularTotal($novoPedido->id);

        $novoPedido->update([
            'total' => $total
        ]);

        return $novoPedido;
    }

    /**
     * Calcula o total do pedido
     */
    public static function calcularTotal(int $pedidoId)
    {
        return ItensDosPedidos::where('pedido_id', $pedidoId)->sum('subtotal');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\PedidoRequest;
use App\Http\Resources\CollectionPedidoResource;
use App\Http\Resources\CriarPedidoResource;
use App\Http\Resources\MensagemResource;
use App\Models\Pedido;
use App\Services\PedidoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PedidoController extends Controller
{
    /**
     * @title Lista os pedidos
     * @param [int] $id ID do pedido (opcional)
     * @param [int] $usuario_id ID do usuário (opcional)
     * @success 200
     */
    public function index(Request $request): JsonResponse
    {
        $value = Cache::get('key');

        $pedidos = Pedido::with(['produto' => function ($query) {
            $query->select('produtos.*')->withPivot(['quantidade', 'subtotal']);
        }])
            ->when($request->id, fn($query) => $query->where('id', $request->id))
            ->when($request->usuario_id, fn($query) => $query->where('usuario_id', $request->usuario_id))
            ->paginate();

        return response()->json(new CollectionPedidoResource($pedidos), 200);
    }

    /**
     * @title Cria um pedido
     * @param [array] $produtos Array com os produtos contendo produto_id e quantidade (obrigatório)
     * @success 201
     * @erro 401
     */
    public function store(PedidoRequest $request)
    {
        return new CriarPedidoResource(PedidoService::criarPedido($request->validated()), 201);
    }

    /**
     * @title Atualiza um pedido
     * @param [int] $id ID do pedido (obrigatório)
     * @success 200
     * @erro 401
     */
    public function update(Request $request, Pedido $pedido)
    {
        $pedido->update([
            'status' => $request->status
        ]);

        return response()->json(new MensagemResource('Pedido atualizado com sucesso.'), 200);
    }
}

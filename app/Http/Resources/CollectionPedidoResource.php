<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CollectionPedidoResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(fn($pedido) => [
                'id' => $pedido->id,
                'usuario_id' => $pedido->usuario_id,
                'status' => $pedido->status,
                'total' => $pedido->total,
                'criado_em' => $pedido->criado_em,
                'produtos' => $pedido->produto->map(fn($produto) => [
                    'id' => $produto->id,
                    'nome' => $produto->nome,
                    'preco' => $produto->preco,
                    'quantidade' => $produto->pivot->quantidade,
                ]),
            ]),
            'links' => [
                'first' => $this->resource->url(1),
                'last' => $this->resource->url($this->resource->lastPage()),
                'prev' => $this->resource->previousPageUrl(),
                'next' => $this->resource->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $this->resource->currentPage(),
                'from' => $this->resource->firstItem(),
                'last_page' => $this->resource->lastPage(),
                'path' => $this->resource->path(),
                'per_page' => $this->resource->perPage(),
                'to' => $this->resource->lastItem(),
                'total' => $this->resource->total(),
            ]
        ];
    }
}

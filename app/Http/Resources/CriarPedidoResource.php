<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CriarPedidoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'status' => $this->status,
            'total' => $this->total,
            'criado_em' => $this->criado_em,
            'produtos' => $this->produto->map(fn($produto) => [
                'id' => $produto->id,
                'nome' => $produto->nome,
                'preco' => $produto->preco,
                'quantidade' => $produto->pivot->quantidade,
            ]),
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PedidoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'produtos' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'produtos.required' => 'O campo produtos é obrigatório!',
            'produtos.array' => 'O campo produtos tem que ser um array!',
        ];
    }
}

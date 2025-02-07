<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'preco',
        'criado_em',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function pedido()
    {
        return $this->belongsToMany(Pedido::class, 'itens_dos_pedidos', 'produto_id', 'pedido_id')->withTimestamps();
    }
}

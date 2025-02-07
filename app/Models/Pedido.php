<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Events\Dispatchable;

class Pedido extends Model
{
    use HasFactory, Dispatchable;

    protected $fillable = [
        'usuario_id',
        'status',
        'total',
        'criado_em',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function produto()
    {
        return $this->belongsToMany(Produto::class, 'itens_dos_pedidos', 'pedido_id', 'produto_id')
            ->withPivot(['quantidade', 'subtotal'])
            ->withTimestamps();
    }
}

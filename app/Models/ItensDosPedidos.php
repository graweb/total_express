<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItensDosPedidos extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedido_id',
        'produto_id',
        'quantidade',
        'subtotal',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function produto()
    {
        return $this->hasMany(Produto::class);
    }
}

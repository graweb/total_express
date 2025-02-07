<?php

namespace App\Jobs;

use App\Models\Pedido;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class VerificarPedidosPendentes implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pedidosExpirados = Pedido::where('status', 'pendente')
            ->where('criado_em', '<=', Carbon::now()->subHours(24))
            ->get();

        foreach ($pedidosExpirados as $pedido) {
            $pedido->status = 'expirado';
            $pedido->save();
        }
    }
}

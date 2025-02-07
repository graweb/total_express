<?php

namespace Database\Seeders;

use App\Models\ItensDosPedidos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItensDosPedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ItensDosPedidos::factory(100)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Usuário teste',
            'email' => 'user@totalexpress.com.br',
            'password' => Hash::make('senha'),
        ]);

        User::factory(9)->create();

        $this->call([
            ProdutoSeeder::class,
            PedidoSeeder::class,
            ItensDosPedidosSeeder::class,
        ]);
    }
}

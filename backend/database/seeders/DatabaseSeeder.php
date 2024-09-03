<?php

namespace Database\Seeders;

use App\Models\Estabelecimento;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $this->call([
        UserSeeder::class,
        CategoriaEstabelecimentoSeeder::class,
        CategoriaProdutoSeeder::class,
      ]);
      Estabelecimento::factory(3)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoriaEstabelecimento;

class CategoriaEstabelecimentoSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $categorias = [
      'Restaurante',
      'Cafeteria',
      'Padaria',
      'Supermercado',
      'Farmácia',
      'Academia',
      'Pet Shop',
      'Loja de Roupas'
    ];

    foreach ($categorias as $categoria) {
      CategoriaEstabelecimento::create([
        'nome' => $categoria,
      ]);
    }
  }
}

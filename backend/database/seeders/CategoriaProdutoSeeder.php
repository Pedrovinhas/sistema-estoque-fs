<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoriaProduto;

class CategoriaProdutoSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $categorias = [
      'Suplementos',
      'Roupas e Acessórios',
      'Beleza e Cuidados Pessoais',
      'Eletrônicos',
      'Pet Produtos',
      'Produtos de Limpeza',
      'Livros'
  ];

    foreach ($categorias as $categoria) {
      CategoriaProduto::create([
        'nome' => $categoria,
      ]);
    }
  }
}

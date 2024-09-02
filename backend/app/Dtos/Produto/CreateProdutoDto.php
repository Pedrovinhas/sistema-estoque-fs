<?php

namespace App\Dtos\Produto;

class CreateProdutoDto
{
  public function __construct(
    public readonly string $name,
    public readonly float $value,
    public readonly int $categoria_produto_id,
    public readonly int $estabelecimento_id
  ) {}
}

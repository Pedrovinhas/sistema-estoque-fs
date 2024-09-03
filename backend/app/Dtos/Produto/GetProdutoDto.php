<?php

namespace App\Dtos\Produto;

class GetProdutoDto
{
  public function __construct(
    public readonly int $id,
    public readonly string $name,
    public readonly float $value,
    public readonly string $categoria_produto_name,
    public readonly int $estabelecimento_id,
    public readonly string $estabelecimento_name
  ) {}
}

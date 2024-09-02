<?php

namespace App\Dtos\Produto;

class GetProdutoDto
{
  public function __construct(
    public readonly string $name,
    public readonly float $value,
    public readonly string $categoria_produto_name,
    public readonly string $estabelecimento_name
  ) {}
}

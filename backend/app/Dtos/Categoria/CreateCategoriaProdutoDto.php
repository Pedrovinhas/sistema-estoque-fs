<?php

namespace App\Dtos\Categoria;

class CreateCategoriaProdutoDto
{
  public function __construct(
    public readonly string $name
  ) {}
}

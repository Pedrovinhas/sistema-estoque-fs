<?php

namespace App\Dtos\Categoria;

class CreateCategoriaEstabelecimentoDto
{
  public function __construct(
    public readonly string $name
  ) {}
}

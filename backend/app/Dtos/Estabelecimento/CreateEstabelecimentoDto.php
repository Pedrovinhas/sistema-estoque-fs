<?php

namespace App\Dtos\Estabelecimento;

class CreateEstabelecimentoDto
{
  public function __construct(
    public readonly string $name,
    public readonly string $description,
    public readonly string $cep,
    public readonly int $categoria_estabelecimento_id
  ) {}
}

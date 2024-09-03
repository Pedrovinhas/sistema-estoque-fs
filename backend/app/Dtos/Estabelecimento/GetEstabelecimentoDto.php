<?php

namespace App\Dtos\Estabelecimento;

class GetEstabelecimentoDto
{
  public function __construct(
    public readonly int $id,
    public readonly string $name,
    public readonly string $description,
    public readonly string $cep,
    public readonly string $categoria_estabelecimento_name
  ) {}
}

<?php

namespace App\Services;

use App\Contracts\Services\EstabelecimentoServiceContract as Contract;
use App\Contracts\Sources\EstabelecimentoSourceContract as EstabelecimentoSource;
use App\Dtos\Estabelecimento\CreateEstabelecimentoDto;
use App\Filters\EstabelecimentoFilter;

class EstabelecimentoService implements Contract
{
  public function __construct(
    private readonly EstabelecimentoSource $source
  ) {}

  public function create(CreateEstabelecimentoDto $dto): void
  {
    $this->source->save($dto);
  }

  public function getAll(EstabelecimentoFilter $filter): array
  {
    $categorias = $this->source->getAll($filter);

    return $categorias;
  }
}

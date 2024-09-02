<?php

namespace App\Contracts\Services;

use App\Dtos\Estabelecimento\CreateEstabelecimentoDto;
use App\Filters\EstabelecimentoFilter;

interface EstabelecimentoServiceContract
{
  public function create(CreateEstabelecimentoDto $dto): void;

  public function getAll(EstabelecimentoFilter $filter): array;

  public function getPedidos(string $estabelecimentoId): array;
}
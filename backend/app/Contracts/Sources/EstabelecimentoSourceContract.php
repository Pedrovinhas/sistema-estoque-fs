<?php

namespace App\Contracts\Sources;

use App\Filters\EstabelecimentoFilter;

interface EstabelecimentoSourceContract
{
  public function save($estabelecimento): void;

  public function getAll(EstabelecimentoFilter $filter): array;

}
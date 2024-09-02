<?php

namespace App\Contracts\Sources;

use App\Filters\CategoriaFilter;

interface CategoriaEstabelecimentoSourceContract
{
  public function save($categoria): void;

  public function getAll(CategoriaFilter $filter): array;

}
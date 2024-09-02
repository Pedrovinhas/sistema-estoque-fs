<?php

namespace App\Contracts\Sources;

use App\Filters\CategoriaFilter;

interface CategoriaProdutoSourceContract
{
  public function save($categoria): void;

  public function getAll(CategoriaFilter $filter): array;

}
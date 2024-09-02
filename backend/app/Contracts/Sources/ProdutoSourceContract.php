<?php

namespace App\Contracts\Sources;

use App\Filters\ProdutoFilter;

interface ProdutoSourceContract
{
  public function save($produto): void;

  public function find(int $produtoId);

  public function getAll(ProdutoFilter $filter): array;
}

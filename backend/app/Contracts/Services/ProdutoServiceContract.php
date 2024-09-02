<?php

namespace App\Contracts\Services;

use App\Dtos\Produto\CreateProdutoDto;
use App\Filters\ProdutoFilter;

interface ProdutoServiceContract
{
  public function create(CreateProdutoDto $dto): void;

  public function getAll(ProdutoFilter $filter): array;
}
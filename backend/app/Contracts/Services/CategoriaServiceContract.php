<?php

namespace App\Contracts\Services;

use App\Dtos\Categoria\CreateCategoriaEstabelecimentoDto;
use App\Dtos\Categoria\CreateCategoriaProdutoDto;
use App\Filters\CategoriaFilter;

interface CategoriaServiceContract
{
  public function createCategoriaProduto(CreateCategoriaProdutoDto $dto): void;

  public function createCategoriaEstabelecimento(CreateCategoriaEstabelecimentoDto $dto): void;

  public function getAllCategoriaProduto(CategoriaFilter $filter): array;

  public function getAllCategoriaEstabelecimento(CategoriaFilter $filter): array;
}
<?php

namespace App\Services;

use App\Contracts\Services\CategoriaServiceContract as Contract;
use App\Contracts\Sources\CategoriaProdutoSourceContract as CategoriaProdutoSource;
use App\Contracts\Sources\CategoriaEstabelecimentoSourceContract as CategoriaEstabelecimentoSource;
use App\Dtos\Categoria\CreateCategoriaEstabelecimentoDto;
use App\Dtos\Categoria\CreateCategoriaProdutoDto;
use App\Filters\CategoriaFilter;

class CategoriaService implements Contract
{

  public function __construct(
    private readonly CategoriaProdutoSource $categoriaProdutoSource,
    private readonly CategoriaEstabelecimentoSource $categoriaEstabelecimentoSource
  ) {}

  public function createCategoriaProduto(CreateCategoriaProdutoDto $dto): void
  {
    $this->categoriaProdutoSource->save($dto);
  }

  public function createCategoriaEstabelecimento(CreateCategoriaEstabelecimentoDto $dto): void
  {
    $this->categoriaEstabelecimentoSource->save($dto);
  }

  public function getAllCategoriaEstabelecimento(CategoriaFilter $filter): array
  {
    $categorias = $this->categoriaEstabelecimentoSource->getAll($filter);

    return $categorias;
  }

  public function getAllCategoriaProduto(CategoriaFilter $filter): array
  {
    $categorias = $this->categoriaProdutoSource->getAll($filter);

    return $categorias;
  }
}

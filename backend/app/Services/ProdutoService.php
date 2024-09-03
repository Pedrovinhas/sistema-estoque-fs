<?php

namespace App\Services;

use App\Contracts\Services\ProdutoServiceContract as Contract;
use App\Contracts\Sources\ProdutoSourceContract as ProdutoSource;
use App\Dtos\Produto\CreateProdutoDto;
use App\Dtos\Produto\GetProdutoDto;
use App\Filters\ProdutoFilter;

class ProdutoService implements Contract
{
  public function __construct(
    private readonly ProdutoSource $source
  ) {}

  public function create(CreateProdutoDto $dto): void
  {
    $this->source->save($dto);
  }

  public function getAll(ProdutoFilter $filter): array
  {
    $produtos = $this->source->getAll($filter);

    // TODO: Mudar retorno para tirar array associativo
    $produtosDto = array_map(function($produto) {
      return new GetProdutoDto(
          $produto['id'],
          $produto['nome'],
          $produto['valor'],
          $produto['categoria']['nome'],
          $produto['estabelecimento']['id'],
          $produto['estabelecimento']['nome'],
      );
  }, $produtos);

    return $produtosDto;
  }
}

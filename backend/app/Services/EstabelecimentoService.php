<?php

namespace App\Services;

use App\Contracts\Services\EstabelecimentoServiceContract as Contract;
use App\Contracts\Sources\EstabelecimentoSourceContract as EstabelecimentoSource;
use App\Contracts\Sources\PedidoSourceContract as PedidoSource;
use App\Dtos\Estabelecimento\CreateEstabelecimentoDto;
use App\Dtos\Pedido\GetPedidoDto;
use App\Filters\EstabelecimentoFilter;

class EstabelecimentoService implements Contract
{
  public function __construct(
    private readonly EstabelecimentoSource $source,
    private readonly PedidoSource $pedidoSource
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

  public function getPedidos(string $estabelecimentoId): array
  {
    $this->source->find($estabelecimentoId);

    $pedidos = $this->pedidoSource->getByEstabelecimentoId($estabelecimentoId);

    // TODO: Mudar retorno para tirar array associativo
    $pedidosDto = array_map(function ($pedido) {
      return new GetPedidoDto(
        $pedido['produto']['nome'],
        $pedido['produto']['valor'],
        $pedido['estabelecimento']['nome'],
        $pedido['cliente']['nome']
      );
    }, $pedidos);

    return $pedidosDto;
  }
}

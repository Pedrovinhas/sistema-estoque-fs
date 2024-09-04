<?php

namespace App\Contracts\Services;

use App\Dtos\Pedido\CreatePedidoDto;
use App\Filters\PedidoFilter;

interface PedidoServiceContract
{
  public function create(CreatePedidoDto $dto): void;

  public function getEstabelecimentoPedidos(int $estabelecimentoId): array;

  public function getUsuarioPedidos(int $userId, PedidoFilter $filter): array;
}
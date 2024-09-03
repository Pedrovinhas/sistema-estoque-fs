<?php

namespace App\Contracts\Services;

use App\Dtos\Pedido\CreatePedidoDto;

interface PedidoServiceContract
{
  public function create(CreatePedidoDto $dto): void;

  public function getEstabelecimentoPedidos(int $estabelecimentoId): array;

  public function getUsuarioPedidos(int $userId): array;
}
<?php

namespace App\Contracts\Services;

use App\Dtos\Pedido\CreatePedidoDto;

interface PedidoServiceContract
{
  public function create(CreatePedidoDto $dto): void;
}
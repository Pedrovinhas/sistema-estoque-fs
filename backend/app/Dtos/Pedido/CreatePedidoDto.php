<?php

namespace App\Dtos\Pedido;

class CreatePedidoDto
{
  public function __construct(
    public readonly int $produto_id,
    public readonly int $estabelecimento_id,
    public readonly int $user_id
  ) {}
}

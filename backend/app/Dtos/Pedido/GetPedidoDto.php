<?php

namespace App\Dtos\Pedido;

class GetPedidoDto
{
  public function __construct(
    public readonly string $produto_name,
    public readonly float $produto_value,
    public readonly string $estabelecimento_name,
    public readonly string $receiver
  ) {}
}

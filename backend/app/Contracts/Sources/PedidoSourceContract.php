<?php

namespace App\Contracts\Sources;

use App\Filters\PedidoFilter;

interface PedidoSourceContract
{
  public function save($pedido): void;

  public function getByEstabelecimentoId(string $estabelecimentoId): array;

  public function getByUserId(string $userId, PedidoFilter $filter): array;
}
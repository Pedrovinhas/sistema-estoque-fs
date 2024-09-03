<?php

namespace App\Contracts\Sources;

interface PedidoSourceContract
{
  public function save($pedido): void;

  public function getByEstabelecimentoId(string $estabelecimentoId): array;

  public function getByUserId(string $userId): array;
}
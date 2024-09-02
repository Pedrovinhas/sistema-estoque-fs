<?php

namespace App\Sources;

use App\Models\Pedido as Model;
use App\Contracts\Sources\PedidoSourceContract as SourceInterface;

class PedidoSource implements SourceInterface
{
  public function save($pedido): void
  {
    $model = new Model([
      Model::ESTABELECIMENTO_ID => $pedido->estabelecimento_id,
      Model::PRODUTO_ID => $pedido->produto_id,
      Model::USER_ID => $pedido->user_id,
    ]);

    $model->save();
  }

  public function getByEstabelecimentoId(string $estabelecimentoId): array
  {
    return Model::query()
      ->where(Model::ESTABELECIMENTO_ID ,'=', $estabelecimentoId)
      ->get()
      ->toArray();
  }
}

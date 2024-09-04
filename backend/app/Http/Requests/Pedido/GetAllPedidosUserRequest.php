<?php

namespace App\Http\Requests\Pedido;

use App\Filters\PedidoFilter;
use App\Http\Requests\BaseRequest;

class GetAllPedidosUserRequest extends BaseRequest
{
  public function rules(): array
  {
    return
      [
        'name' => 'sometimes|string',
      ];
  }

  public function getFilter(): PedidoFilter
  {
    $filter = new PedidoFilter();

    if ($this->has('name')) {
      $filter->name = $this->query('name');
    }

    return $filter;
  }
}

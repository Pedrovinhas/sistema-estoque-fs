<?php

namespace App\Http\Requests\Estabelecimento;

use App\Filters\EstabelecimentoFilter;
use App\Http\Requests\BaseRequest;

class GetAllRequest extends BaseRequest
{
  public function rules(): array
  {
    return
      [
        'name'                         => 'sometimes|string',
        'categoria_estabelecimento_id' => 'sometimes|string',
      ];
  }

  public function getFilter(): EstabelecimentoFilter
  {
    $filter = new EstabelecimentoFilter();

    if($this->has('name')) {
      $filter->name = $this->query('name');
    }

    if($this->has('categoria_estabelecimento_id')) {
      $filter->categoriaEstabelecimentoId = $this->query('categoria_estabelecimento_id');
    }

    return $filter;
  }
}

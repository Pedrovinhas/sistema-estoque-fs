<?php

namespace App\Http\Requests\Produto;

use App\Filters\ProdutoFilter;
use App\Http\Requests\BaseRequest;

class GetAllRequest extends BaseRequest
{
  public function rules(): array
  {
    return
      [
        'name'                         => 'sometimes|string',
        'categoria_produto_id'         => 'sometimes|string',
        'estabelecimento_id'           => 'sometimes|string',
      ];
  }

  public function getFilter(): ProdutoFilter
  {
    $filter = new ProdutoFilter();

    if ($this->has('name')) {
      $filter->name = $this->query('name');
    }

    if ($this->has('categoria_produto_id')) {
      $filter->categoriaProdutoId = $this->query('categoria_produto_id');
    }

    if ($this->has('estabelecimento_id')) {
      $filter->estabelecimentoId = $this->query('estabelecimento_id');
    }

    return $filter;
  }
}

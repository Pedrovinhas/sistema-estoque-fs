<?php

namespace App\Http\Requests\Categoria;

use App\Filters\CategoriaFilter;
use App\Http\Requests\BaseRequest;

class GetAllRequest extends BaseRequest
{
  public function rules(): array
  {
    return
      [
        'name' => 'sometimes|string',
      ];
  }

  public function getFilter(): CategoriaFilter
  {
    $filter = new CategoriaFilter();

    if($this->has('name')) {
      $filter->name = $this->query('name');
    }

    return $filter;
  }
}

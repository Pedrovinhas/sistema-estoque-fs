<?php

namespace App\Http\Requests\Categoria;

use App\Filters\CategoriaFilter;
use Illuminate\Foundation\Http\FormRequest;

class GetAllRequest extends FormRequest
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

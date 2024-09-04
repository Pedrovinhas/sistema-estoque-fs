<?php

namespace App\Http\Requests\Categoria;

use App\Dtos\Categoria\CreateCategoriaProdutoDto as Dto;
use App\Http\Requests\BaseRequest;

class CreateCategoriaProdutoRequest extends BaseRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name' => [
        'required',
        'min:3',
        'max:255',
      ],
    ];
  }

  public function toDto(): Dto
  {
    $dto = new Dto(
      $this->post('name'),
    );

    return $dto;
  }
}

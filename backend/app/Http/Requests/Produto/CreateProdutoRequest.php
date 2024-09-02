<?php

namespace App\Http\Requests\Produto;

use App\Dtos\Produto\CreateProdutoDto as Dto;
use App\Http\Requests\BaseRequest;

class CreateProdutoRequest extends BaseRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name'                         => ['required', 'min:3', 'max:100'],
      'value'                        => ['required', 'numeric'],
      'categoria_produto_id'         => ['required', 'integer', 'exists:categoria_estabelecimento,id'],
      'estabelecimento_id'           => ['required', 'integer', 'exists:estabelecimento,id'],
    ];
  }

  public function toDto(): Dto
  {
    $dto = new Dto(
      $this->post('name'),
      $this->post('value'),
      $this->post('categoria_produto_id'),
      $this->post('estabelecimento_id'),
    );

    return $dto;
  }
}

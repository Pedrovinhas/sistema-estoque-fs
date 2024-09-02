<?php

namespace App\Http\Requests\Pedido;

use App\Dtos\Pedido\CreatePedidoDto as Dto;
use App\Http\Requests\BaseRequest;

class CreatePedidoRequest extends BaseRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'produto_id'         => ['required', 'integer', 'exists:produto,id'],
      'estabelecimento_id' => ['required', 'integer', 'exists:estabelecimento,id'],
      'user_id'            => ['required', 'integer', 'exists:users,id'],
    ];
  }

  public function toDto(): Dto
  {
    $dto = new Dto(
      $this->post('produto_id'),
      $this->post('estabelecimento_id'),
      $this->post('user_id'),
    );

    return $dto;
  }
}

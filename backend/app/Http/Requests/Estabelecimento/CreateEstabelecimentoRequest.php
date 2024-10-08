<?php

namespace App\Http\Requests\Estabelecimento;

use App\Dtos\Estabelecimento\CreateEstabelecimentoDto as Dto;
use App\Http\Requests\BaseRequest;

class CreateEstabelecimentoRequest extends BaseRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name'                         => ['required','min:3','max:100'],
      'description'                  => ['required','min:3','max:255'],
      'cep'                          => ['required', 'string', 'size:8'],
      'categoria_estabelecimento_id' => ['required', 'integer', 'exists:categoria_estabelecimento,id'],
    ];
  }

  public function toDto(): Dto
  {
    $dto = new Dto(
      $this->post('name'),
      $this->post('description'),
      $this->post('cep'),
      $this->post('categoria_estabelecimento_id'),
    );

    return $dto;
  }
}

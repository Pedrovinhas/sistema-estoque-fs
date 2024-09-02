<?php

namespace App\Http\Requests\Categoria;

use App\Dtos\Categoria\CreateCategoriaEstabelecimentoDto as Dto;
use Illuminate\Foundation\Http\FormRequest;

class CreateCategoriaEstabelecimentoRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

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

<?php

namespace App\Http\Requests;

use App\Constants\ValidationMessage;
use App\Exceptions\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

abstract class BaseRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * @throws ValidationException
   */
  protected function failedValidation(Validator $validator)
  {
    throw ValidationException::requestValidation($validator);
  }

  public function messages(): array
  {
    return [
      "required" => ValidationMessage::REQUIRED,
      "required_unless" => ValidationMessage::REQUIRED,
      "min" => ValidationMessage::MIN,
      "max" => ValidationMessage::MAX,
      "between" => ValidationMessage::BETWEEN,
      "string" => ValidationMessage::TYPE,
      "numeric" => ValidationMessage::TYPE,
      "boolean" => ValidationMEssage::TYPE,
      "email" => ValidationMessage::EMAIL,
      "uuid" => ValidationMessage::UUID,
      "json" => ValidationMessage::TYPE,
      "date_format" => ValidationMessage::DATE_FORMAT,
      "array" => ValidationMessage::TYPE,
      "required_if" => ValidationMessage::REQUIRED,
      "digits_between" => ValidationMessage::BETWEEN,
      "exists" => ValidationMessage::EXISTS,
      "gte" => ValidationMessage::MIN,
      "lte" => ValidationMessage::MAX
    ];
  }

  public function attributes()
  {
    return collect($this->rules())->keys()
      ->filter(function ($field) {
        return str($field)->contains('_');
      })->mapWithKeys(function ($field) {
        return [$field => $field];
      })->toArray();
  }

  protected function dotValidated(string $key, $default = null)
  {
    return Arr::get($this->validated(), $key, $default);
  }
}

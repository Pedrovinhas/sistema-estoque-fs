<?php

namespace App\Exceptions;

use Illuminate\Contracts\Validation\Validator;
use Throwable;

class ValidationException extends Exception
{
  protected function __construct(
    string $errorCode,
    string $message,
    ?Throwable $previous = null,
    private ?Validator $validator = null,
  ) {
    parent::__construct(
      $errorCode,
      'Validation Error',
      $message,
      previous: $previous
    );

    if (!is_null($validator)) {
      foreach ($validator->errors()->all() as $error) {
        $this->appendDetail($this->formatValidatorError($error));
      }
    }
  }

  public static function requestValidation(Validator $validator, ?Throwable $previous = null)
  {
    return new static(
      '401',
      'Falha na validação dos dados da requisição',
      previous: $previous,
      validator: $validator,
    );
  }

  public static function invalidArgument(string $field, string $rule)
  {
    $exception =  new static(
      '401',
      'Os argumentos enviados estão inválidos',
    );

    $exception->appendDetail([
      "field" => $field,
      "rule" => $rule,
    ]);

    return $exception;
  }

  private function formatValidatorError(string $error)
  {
    [$field, $rule] = explode('.', $error);

    return [
      "field" => $field,
      "rule" => $rule,
    ];
  }
}

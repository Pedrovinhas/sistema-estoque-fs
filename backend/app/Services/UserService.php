<?php

namespace App\Services;

use App\Contracts\Services\UserServiceContract as Contract;
use App\Contracts\Sources\UserSourceContract as UserSource;
use App\Dtos\User\UserDto;

class UserService implements Contract
{
  public function __construct(
    private readonly UserSource $source
  ) {}

  public function get(int $userId): object
  {
    $user = $this->source->find($userId);

    $userDto = new UserDto(
      $user->id,
      $user->email,
      $user->nome,
      $user->saldo
    );

    return $userDto;
  }
}

<?php

namespace App\Dtos\User;

class UserDto
{
  public function __construct(
    public readonly int $id,
    public readonly string $email,
    public readonly string $name,
    public readonly float $value,
  ) {}
}

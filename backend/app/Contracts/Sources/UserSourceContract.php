<?php

namespace App\Contracts\Sources;

use App\Models\User;

interface UserSourceContract
{
  public function find(int $userId): User|null;

  public function updateBalance(int $userId, float $balance): void;
}

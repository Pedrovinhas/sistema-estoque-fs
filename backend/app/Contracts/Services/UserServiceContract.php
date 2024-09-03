<?php

namespace App\Contracts\Services;

interface UserServiceContract
{
  public function get(int $userId): object;
}
<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserServiceContract as UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
  public function __construct(
    private readonly UserService $service,
  ) {}

  public function getUser(int $userId)
  {
    $user = $this->service->get($userId);

    return response()->json($user, Response::HTTP_OK);
  }
}

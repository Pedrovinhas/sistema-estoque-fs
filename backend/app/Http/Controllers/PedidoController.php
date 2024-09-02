<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Contracts\Services\PedidoServiceContract as PedidoService;
use App\Http\Requests\Pedido\CreatePedidoRequest;

class PedidoController extends Controller
{
  public function __construct(
    private readonly PedidoService $service,
  ) {}

  public function create(CreatePedidoRequest $request)
  {
    $this->service->create($request->toDto());

    return response(null, Response::HTTP_CREATED);
  }
}

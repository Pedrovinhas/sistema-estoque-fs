<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Contracts\Services\PedidoServiceContract as PedidoService;
use App\Http\Requests\Pedido\CreatePedidoRequest;
use App\Http\Requests\Pedido\GetAllPedidosUserRequest;

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

  public function listPedidosByEstabelecimento(int $estabelecimentoId)
  {
    $pedidos = $this->service->getEstabelecimentoPedidos($estabelecimentoId);

    $serializedData = array_map(function ($pedido) {
      return [
        'produto_name' => $pedido->produto_name,
        'produto_value' => $pedido->produto_value,
        'receiver' => $pedido->receiver,
      ];
    }, $pedidos);

    return response()->json($serializedData);
  }

  public function listPedidosByUser(int $userId, GetAllPedidosUserRequest $request)
  {
    $pedidos = $this->service->getUsuarioPedidos($userId, $request->getFilter());

    // TODO: Usar resource para serializar os dados
    $serializedData = array_map(function ($pedido) {
      return [
        'produto_name' => $pedido->produto_name,
        'produto_value' => $pedido->produto_value,
        'estabelecimento_name' => $pedido->estabelecimento_name,
      ];
    }, $pedidos);

    return response()->json($serializedData);
  }
}

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

  public function listPedidosByEstabelecimento(int $estabelecimentoId)
  {
    $pedidos = $this->service->getEstabelecimentoPedidos($estabelecimentoId);

    return $pedidos;
  }

  public function listPedidosByUser(int $userId)
  {
    $pedidos = $this->service->getUsuarioPedidos($userId);

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

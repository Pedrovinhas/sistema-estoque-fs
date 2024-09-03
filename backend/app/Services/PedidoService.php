<?php

namespace App\Services;

use App\Contracts\Services\PedidoServiceContract as Contract;
use App\Contracts\Sources\PedidoSourceContract as PedidoSource;
use App\Contracts\Sources\UserSourceContract as UserSource;
use App\Contracts\Sources\ProdutoSourceContract as ProdutoSource;
use App\Dtos\Pedido\CreatePedidoDto;
use App\Dtos\Pedido\GetPedidoDto;
use App\Sources\EstabelecimentoSource;
use Core\Exceptions\InsufficientBalanceException;
use Illuminate\Support\Facades\DB;

class PedidoService implements Contract
{
  public function __construct(
    private readonly PedidoSource $source,
    private readonly ProdutoSource $produtoSource,
    private readonly EstabelecimentoSource $estabelecimentoSource,
    private readonly UserSource $userSource
  ) {}

  public function create(CreatePedidoDto $dto): void
  {
    DB::beginTransaction();

    try {
      $produto = $this->produtoSource->find($dto->produto_id);

      $this->verifyUserBalance($dto->user_id, $produto->valor);
      $this->deductUserBalance($dto->user_id, $produto->valor);

      $this->source->save($dto);
      DB::commit();
    } catch (\Throwable $e) {
      DB::rollBack();
      throw $e;
    }
  }

  public function getEstabelecimentoPedidos(int $estabelecimentoId): array
  {
    $this->estabelecimentoSource->find($estabelecimentoId);

    $pedidos = $this->source->getByEstabelecimentoId($estabelecimentoId);

    // TODO: Mudar retorno para tirar array associativo
    $pedidosDto = array_map(function ($pedido) {
      return new GetPedidoDto(
        $pedido['produto']['nome'],
        $pedido['produto']['valor'],
        $pedido['estabelecimento']['nome'],
        $pedido['cliente']['nome']
      );
    }, $pedidos);

    return $pedidosDto;
  }

  public function getUsuarioPedidos(int $userId): array
  {
    $this->userSource->find($userId);

    $pedidos = $this->source->getByUserId($userId);

    // TODO: Mudar retorno para tirar array associativo
    $pedidosDto = array_map(function ($pedido) {
      return new GetPedidoDto(
        $pedido['produto']['nome'],
        $pedido['produto']['valor'],
        $pedido['estabelecimento']['nome'],
        $pedido['cliente']['nome']
      );
    }, $pedidos);

    return $pedidosDto;
  }

  private function verifyUserBalance(int $userId, float $amount): void
  {
    $user = $this->userSource->find($userId);

    if ($user->saldo < $amount) {
      throw new InsufficientBalanceException($amount, $user->saldo);
    }
  }

  private function deductUserBalance(int $userId, float $amount): void
  {
    $user = $this->userSource->find($userId);

    $newBalance = $user->saldo -= $amount;

    $this->userSource->updateBalance($userId, $newBalance);
  }
}

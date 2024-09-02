<?php

namespace App\Services;

use App\Contracts\Services\PedidoServiceContract as Contract;
use App\Contracts\Sources\PedidoSourceContract as PedidoSource;
use App\Contracts\Sources\UserSourceContract as UserSource;
use App\Contracts\Sources\ProdutoSourceContract as ProdutoSource;
use App\Dtos\Pedido\CreatePedidoDto;
use Core\Exceptions\InsufficientBalanceException;
use Illuminate\Support\Facades\DB;

class PedidoService implements Contract
{
  public function __construct(
    private readonly PedidoSource $source,
    private readonly ProdutoSource $produtoSource,
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

<?php

namespace App\Services;

use App\Contracts\Services\EstabelecimentoServiceContract as Contract;
use App\Contracts\Sources\EstabelecimentoSourceContract as EstabelecimentoSource;
use App\Contracts\Sources\PedidoSourceContract as PedidoSource;
use App\Dtos\Estabelecimento\CreateEstabelecimentoDto;
use App\Dtos\Estabelecimento\GetEstabelecimentoDto;
use App\Filters\EstabelecimentoFilter;

class EstabelecimentoService implements Contract
{
  public function __construct(
    private readonly EstabelecimentoSource $source,
    private readonly PedidoSource $pedidoSource
  ) {}

  public function create(CreateEstabelecimentoDto $dto): void
  {
    $this->source->save($dto);
  }

  public function getAll(EstabelecimentoFilter $filter): array
  {
    $estabelecimentos = $this->source->getAll($filter);

    // TODO: Mudar retorno de Collection para tirar array associativo
    $estabelecimentosDto = array_map(function ($estabelecimento) {
      return new GetEstabelecimentoDto(
        $estabelecimento['id'],
        $estabelecimento['nome'],
        $estabelecimento['descricao'],
        $estabelecimento['cep'],
        $estabelecimento['categoria']['nome']
      );
    }, $estabelecimentos);

    return $estabelecimentosDto;
  }
}

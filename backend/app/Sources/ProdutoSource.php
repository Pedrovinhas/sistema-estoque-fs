<?php

namespace App\Sources;

use App\Models\Produto as Model;
use App\Contracts\Sources\ProdutoSourceContract as SourceInterface;
use Core\Exceptions\NotFoundException;

class ProdutoSource implements SourceInterface
{
  public function save($produto): void
  {
    $model = new Model([
      Model::NAME => $produto->name,
      Model::VALUE => $produto->value,
      Model::CATEGORIA_PRODUTO_ID => $produto->categoria_produto_id,
      Model::ESTABELECIMENTO_ID => $produto->estabelecimento_id
    ]);

    $model->save();
  }

  public function getAll($filter): array
  {
    return Model::query()
      ->when($filter->hasName(), fn($query) => $query->whereNome($filter->name))
      ->when($filter->hasCategoriaProdutoId(), fn($query) => $query->whereCategoriaProdutoId($filter->categoriaProdutoId))
      ->when($filter->hasEstabelecimentoId(), fn($query) => $query->whereEstabelecimentoId($filter->estabelecimentoId))
      ->get()
      ->toArray();
  }

  public function find($id)
  {
    $result = Model::where(Model::ID, $id)->first();

    if (is_null($result)) {
      throw new NotFoundException('Produto', $id);
    }

    return $result;
  }
}

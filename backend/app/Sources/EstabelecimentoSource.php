<?php

namespace App\Sources;

use App\Models\Estabelecimento as Model;
use App\Contracts\Sources\EstabelecimentoSourceContract as SourceInterface;
use Core\Exceptions\NotFoundException;

class EstabelecimentoSource implements SourceInterface
{
  public function save($estabelecimento): void
  {
    $model = new Model([
      Model::NAME => $estabelecimento->name,
      Model::DESCRIPTION => $estabelecimento->description,
      Model::CEP => $estabelecimento->cep,
      Model::CATEGORIA_ESTABELECIMENTO_ID => $estabelecimento->categoria_estabelecimento_id,
    ]);

    $model->save();
  }

  public function getAll($filter): array
  {
    return Model::query()
      ->when($filter->hasName(), fn($query) => $query->whereNome($filter->name))
      ->when($filter->hasCategoriaEstabelecimentoId(), fn($query) => $query->whereCategoriaEstabelecimentoId($filter->categoriaEstabelecimentoId))
      ->get()
      ->toArray();
  }

  public function find($id)
  {
    $result = Model::where(Model::ID, $id)->first();

    if (is_null($result)) {
      throw new NotFoundException('Estabelecimento', $id);
    }

    return $result;
  }
}

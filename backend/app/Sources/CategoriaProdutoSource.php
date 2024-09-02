<?php

namespace App\Sources;

use App\Models\CategoriaProduto as Model;
use App\Contracts\Sources\CategoriaProdutoSourceContract as SourceInterface;

class CategoriaProdutoSource implements SourceInterface
{
  public function save($categoria): void
  {
    $model = new Model([
      Model::NAME => $categoria->name
    ]);

    $model->save();
  }

  public function getAll($filter): array
  {
    return Model::query()
      ->when($filter->hasName(), fn($query) => $query->whereNome($filter->name))
      ->get()
      ->toArray();
  }
}
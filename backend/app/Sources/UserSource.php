<?php

namespace App\Sources;

use App\Models\User as Model;
use App\Contracts\Sources\UserSourceContract as SourceInterface;
use Core\Exceptions\NotFoundException;

class UserSource implements SourceInterface
{
  public function updateBalance($id, $balance): void
  {
    $model = $this->find($id);

    $model->saldo = $balance;

    $model->save();
  }

  public function find($id): Model
  {
    $result = Model::where(Model::ID, $id)->first();

    if (is_null($result)) {
      throw new NotFoundException('Estabelecimento', $id);
    }

    return $result;
  }
}

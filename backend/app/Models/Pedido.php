<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'pedido';

  const ID = 'id';
  const ESTABELECIMENTO_ID = 'estabelecimento_id';
  const PRODUTO_ID = 'produto_id';
  const USER_ID = 'user_id';

  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';
  const DELETED_AT = 'deleted_at';

  protected $fillable = [
    self::ESTABELECIMENTO_ID,
    self::PRODUTO_ID,
    self::USER_ID,
  ];

  protected $hidden = [
    self::CREATED_AT,
    self::UPDATED_AT,
    self::DELETED_AT
  ];

  protected $with = ['estabelecimento', 'produto', 'cliente'];

  public function produto(): BelongsTo
  {
    return $this->belongsTo(Produto::class, self::PRODUTO_ID);
  }

  public function estabelecimento(): BelongsTo
  {
    return $this->belongsTo(Estabelecimento::class, self::ESTABELECIMENTO_ID);
  }

  public function cliente(): BelongsTo
  {
    return $this->belongsTo(User::class, self::USER_ID);
  }
}

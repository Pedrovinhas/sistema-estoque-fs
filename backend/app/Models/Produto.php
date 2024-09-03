<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'produto';

  const ID = 'id';
  const NAME = 'nome';
  const VALUE = 'valor';
  const CATEGORIA_PRODUTO_ID = 'categoria_produto_id';
  const ESTABELECIMENTO_ID = 'estabelecimento_id';

  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';
  const DELETED_AT = 'deleted_at';

  const PRODUTO_ID = 'produto_id';

  protected $fillable = [
    self::NAME,
    self::VALUE,
    self::CATEGORIA_PRODUTO_ID,
    self::ESTABELECIMENTO_ID
  ];

  protected $hidden = [
    self::CREATED_AT,
    self::UPDATED_AT,
    self::DELETED_AT
  ];

  protected $with = ['estabelecimento:id,nome', 'categoria'];

  protected function casts(): array
  {
    return [
      self::VALUE => 'decimal:2'
    ];
  }

  public function categoria(): BelongsTo
  {
    return $this->belongsTo(CategoriaProduto::class, self::CATEGORIA_PRODUTO_ID);
  }

  public function estabelecimento(): BelongsTo
  {
    return $this->belongsTo(Estabelecimento::class, self::ESTABELECIMENTO_ID);
  }

  public function pedidos(): BelongsToMany
  {
      return $this->belongsToMany(Pedido::class, self::PRODUTO_ID);
  }
}

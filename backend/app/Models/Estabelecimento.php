<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estabelecimento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'estabelecimento';

    const ID = 'id';
    const NAME = 'nome';
    const DESCRIPTION = 'descricao';
    const CEP = 'cep';
    const CATEGORIA_ESTABELECIMENTO_ID = 'categoria_estabelecimento_id';

    const ESTABELECIMENTO_ID = 'estabelecimento_id';

    protected $fillable = [
      self::NAME, 
      self::DESCRIPTION, 
      self::CEP,
      self::CATEGORIA_ESTABELECIMENTO_ID
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaEstabelecimento::class, 'categoria_estabelecimento_id');
    }

    public function produtos(): HasMany
    {
      return $this->hasMany(Produto::class, self::ESTABELECIMENTO_ID, self::ID);
    }

    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class, self::ESTABELECIMENTO_ID, self::ID);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoriaProduto extends Model
{
    use HasFactory;

    protected $table = 'categoria_produto';

    const ID = 'id';
    const NAME = 'nome';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const CATEGORIA_PRODUTO_ID = 'categoria_produto_id';

    protected $fillable = [
      self::NAME,
    ];

    protected $hidden = [
      self::CREATED_AT,
      self::UPDATED_AT
    ];

    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class, self::CATEGORIA_PRODUTO_ID, self::ID);
    }

    public function scopeWhereLikeName($query, $name)
    {
        return $query->where(self::NAME, 'ilike', "%{$name}%");
    }
}
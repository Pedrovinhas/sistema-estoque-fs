<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoriaEstabelecimento extends Model
{
    use HasFactory;

    protected $table = 'categoria_estabelecimento';

    const ID = 'id';
    const NAME = 'nome';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const CATEGORIA_ESTABELECIMENTO_ID = 'categoria_estabelecimento_id';

    protected $fillable = [
      self::NAME,
    ];

    protected $hidden = [
      self::CREATED_AT,
      self::UPDATED_AT
    ];

    public function estabelecimentos(): HasMany
    {
        return $this->hasMany(Estabelecimento::class, self::CATEGORIA_ESTABELECIMENTO_ID);
    }

    public function scopeWhereLikeName($query, $name)
    {
        return $query->where(self::NAME, 'ilike', "%{$name}%");
    }
}
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Sources\CategoriaEstabelecimentoSourceContract;
use App\Contracts\Sources\CategoriaProdutoSourceContract;
use App\Contracts\Sources\EstabelecimentoSourceContract;
use App\Contracts\Sources\PedidoSourceContract;
use App\Contracts\Sources\ProdutoSourceContract;
use App\Contracts\Sources\UserSourceContract;
use App\Sources\CategoriaEstabelecimentoSource;
use App\Sources\CategoriaProdutoSource;
use App\Sources\EstabelecimentoSource;
use App\Sources\PedidoSource;
use App\Sources\ProdutoSource;
use App\Sources\UserSource;

class SourceServiceProvider extends ServiceProvider
{
  public $singletons = [
    CategoriaEstabelecimentoSourceContract::class => CategoriaEstabelecimentoSource::class,
    CategoriaProdutoSourceContract::class => CategoriaProdutoSource::class,
    EstabelecimentoSourceContract::class => EstabelecimentoSource::class,
    ProdutoSourceContract::class => ProdutoSource::class,
    PedidoSourceContract::class => PedidoSource::class,
    UserSourceContract::class => UserSource::class,
  ];

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register() {}

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot() {}
}

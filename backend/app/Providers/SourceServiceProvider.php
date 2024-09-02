<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Sources\CategoriaEstabelecimentoSourceContract;
use App\Contracts\Sources\CategoriaProdutoSourceContract;
use App\Contracts\Sources\EstabelecimentoSourceContract;
use App\Sources\CategoriaEstabelecimentoSource;
use App\Sources\CategoriaProdutoSource;
use App\Sources\EstabelecimentoSource;

class SourceServiceProvider extends ServiceProvider
{
  public $singletons = [
    CategoriaEstabelecimentoSourceContract::class => CategoriaEstabelecimentoSource::class,
    CategoriaProdutoSourceContract::class => CategoriaProdutoSource::class,
    EstabelecimentoSourceContract::class => EstabelecimentoSource::class,
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

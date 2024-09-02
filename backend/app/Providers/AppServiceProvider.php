<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\CategoriaServiceContract;
use App\Contracts\Services\EstabelecimentoServiceContract;
use App\Contracts\Services\PedidoServiceContract;
use App\Contracts\Services\ProdutoServiceContract;
use App\Services\CategoriaService;
use App\Services\EstabelecimentoService;
use App\Services\PedidoService;
use App\Services\ProdutoService;

class AppServiceProvider extends ServiceProvider
{
  public $singletons = [
    CategoriaServiceContract::class => CategoriaService::class,
    EstabelecimentoServiceContract::class => EstabelecimentoService::class,
    ProdutoServiceContract::class => ProdutoService::class,
    PedidoServiceContract::class => PedidoService::class,
  ];
  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(): void
  {
    //
  }
}

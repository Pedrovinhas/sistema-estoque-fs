<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Services\CategoriaServiceContract;
use App\Contracts\Services\EstabelecimentoServiceContract;
use App\Services\CategoriaService;
use App\Services\EstabelecimentoService;

class AppServiceProvider extends ServiceProvider
{
  public $singletons = [
    CategoriaServiceContract::class => CategoriaService::class,
    EstabelecimentoServiceContract::class => EstabelecimentoService::class,
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

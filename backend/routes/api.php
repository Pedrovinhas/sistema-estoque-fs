<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EstabelecimentoController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
  Route::prefix('categorias')->group(function () {
    Route::prefix('produto')->group(function () {
      Route::get('/', [CategoriaController::class, 'listCategoriaProduto']);
      Route::post('/', [CategoriaController::class, 'createCategoriaProduto']);
    });
  
    Route::prefix('estabelecimento')->group(function () {
      Route::get('/', [CategoriaController::class, 'listCategoriaEstabelecimento']);
      Route::post('/', [CategoriaController::class, 'createCategoriaEstabelecimento']);
    });
  });

  Route::prefix('estabelecimentos')->group(function () {
    Route::get('/', [EstabelecimentoController::class, 'list']);
    Route::post('/', [EstabelecimentoController::class, 'create']);

    Route::prefix('/{estabelecimentoId}')->group(function () {
      Route::get('/pedidos', [EstabelecimentoController::class, 'getPedidos']);
    });
  });

  Route::prefix('produtos')->group(function () {
    Route::get('/', [ProdutoController::class, 'get']);
    Route::post('/', [ProdutoController::class, 'create']);
  });


  Route::prefix('pedidos')->group(function () {
    Route::post('/', [PedidoController::class, 'create']);
  });
});

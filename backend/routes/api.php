<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EstabelecimentoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;
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
      Route::get('/pedidos', [PedidoController::class, 'listPedidosByEstabelecimento']);
    });
  });

  Route::prefix('produtos')->group(function () {
    Route::get('/', [ProdutoController::class, 'list']);
    Route::post('/', [ProdutoController::class, 'create']);
  });

  Route::prefix('users/{userId}')->group(function () {
    Route::get('/', [UserController::class, 'getUser']);
    Route::get('/pedidos', [PedidoController::class, 'listPedidosByUser']);
  });

  Route::prefix('pedidos')->group(function () {
    Route::post('/', [PedidoController::class, 'create']);
  });
});

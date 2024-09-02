<?php

namespace App\Http\Controllers;

use App\Contracts\Services\CategoriaServiceContract as CategoriaService;
use App\Http\Requests\Categoria\CreateCategoriaEstabelecimentoRequest;
use App\Http\Requests\Categoria\CreateCategoriaProdutoRequest;
use App\Http\Requests\Categoria\GetAllRequest;
use Illuminate\Http\Response;

class CategoriaController extends Controller
{
  public function __construct(
    private readonly CategoriaService $service,
  ) {}

  public function createCategoriaProduto(CreateCategoriaProdutoRequest $request)
  {
    $this->service->createCategoriaProduto($request->toDto());

    return response(null, Response::HTTP_CREATED);
  }

  public function createCategoriaEstabelecimento(CreateCategoriaEstabelecimentoRequest $request)
  {
    $this->service->createCategoriaEstabelecimento($request->toDto());
    
    return response(null, Response::HTTP_CREATED);
  }

  public function listCategoriaProduto(GetAllRequest $request)
  {
    $categorias = $this->service->getAllCategoriaProduto($request->getFilter());
    
    return $categorias;
  }
  
  public function listCategoriaEstabelecimento(GetAllRequest $request)
  {
    $categorias = $this->service->getAllCategoriaEstabelecimento($request->getFilter());

    return $categorias;
  }

}

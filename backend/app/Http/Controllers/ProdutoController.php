<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Contracts\Services\ProdutoServiceContract as ProdutoService;
use App\Http\Requests\Produto\CreateProdutoRequest;
use App\Http\Requests\Produto\GetAllRequest;

class ProdutoController extends Controller
{
  public function __construct(
    private readonly ProdutoService $service,
  ) {}

  public function create(CreateProdutoRequest $request)
  {
    $this->service->create($request->toDto());

    return response(null, Response::HTTP_CREATED);
  }

  public function list(GetAllRequest $request)
  {
    $produtos = $this->service->getAll($request->getFilter());
    
    return $produtos;
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Contracts\Services\EstabelecimentoServiceContract as EstabelecimentoService;
use App\Http\Requests\Estabelecimento\CreateEstabelecimentoRequest;
use App\Http\Requests\Estabelecimento\GetAllRequest;

class EstabelecimentoController extends Controller
{
  public function __construct(
    private readonly EstabelecimentoService $service,
  ) {}

  public function create(CreateEstabelecimentoRequest $request)
  {
    $this->service->create($request->toDto());

    return response(null, Response::HTTP_CREATED);
  }

  public function list(GetAllRequest $request)
  {
    $estabelecimentos = $this->service->getAll($request->getFilter());
    
    return response()->json($estabelecimentos);
  }
}

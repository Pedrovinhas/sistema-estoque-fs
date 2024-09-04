<?php

namespace App\Exceptions;

use Throwable;
use Core\Exceptions\InsufficientBalanceException;
use Core\Exceptions\NotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    // TODO: Refatorar por completo o Handler de Erro (feito às pressas)
    public function register(): void
    {
      $this->renderable(function (AuthenticationException $e, Request $request): JsonResponse {
        return response()->json([
            'error' => [
                'type' => 'AuthenticationException',
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ]
        ], Response::HTTP_UNAUTHORIZED);
    });

        $this->renderable(function (NotFoundException $e, Request $request): JsonResponse {
            return $this->renderCustomException($e, $request, Response::HTTP_UNPROCESSABLE_ENTITY, [
                'resource' => $e->getName(),
                'identifier' => $e->getIdentifier(),
            ]);
        });

        $this->renderable(function (InsufficientBalanceException $e, Request $request): JsonResponse {
          return response()->json([
              'error' => [
                  'type' => 'InsufficientBalanceException',
                  'message' => $e->getMessage(),
                  'requestedAmount' => $e->getRequestedAmount(),
                  'currentBalance' => $e->getCurrentBalance(),
                  'code' => $e->getCode(),
              ]
          ], Response::HTTP_UNPROCESSABLE_ENTITY);
      });
  
        $this->renderable(function (ValidationException $e, Request $request): JsonResponse {
            return $this->renderCustomException($e, $request, Response::HTTP_BAD_REQUEST, [
                'type'    => $e->getType(),
                'code'    => $e->getErrorCode(),
                'message' => $e->getDetails(),
            ]);
        });
    }
  
    protected function renderCustomException(Throwable $e, Request $request, int $statusCode, array $additionalData = []): JsonResponse
    {
        return response()->json(array_merge([
            'message' => $e->getMessage(),
        ], $additionalData), $statusCode);
    }
}

<?php

namespace App\Http\Middleware;

use App\Exceptions\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class ApiAuthenticate extends Middleware
{
    protected function authenticate($request, array $guards)
    {
        try {
            $this->auth->parseToken()->checkOrFail();
        } catch(TokenInvalidException $tie) {
            throw AuthenticationException::invalidToken($tie);
        } catch(TokenExpiredException $tee) {
            throw AuthenticationException::expiredToken($tee);
        } catch(JWTException $jwte) {
            throw AuthenticationException::tokenNotFound($jwte);
        }
    }
}

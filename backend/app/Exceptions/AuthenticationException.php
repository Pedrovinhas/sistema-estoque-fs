<?php

namespace App\Exceptions;

class AuthenticationException extends Exception
{
    public static function unauthenticated()
    {
        return new static('UNAUTHENTICATED', 'Authentication Error', 'Usuário não autenticado');
    }

    public static function tokenNotFound()
    {
        return new static('TOKEN_NOT_FOUND', 'Authentication Error', 'Token não encontrado');
    }

    public static function invalidToken(?\Throwable $previous = null)
    {
        return new static('INVALID_TOKEN', 'Authentication Error', 'Token inválido', null, $previous);
    }

    public static function expiredToken()
    {
        return new static('EXPIRED_TOKEN', 'Authentication Error', 'Token expirado');
    }
}
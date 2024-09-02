<?php

namespace Core\Exceptions;

use Exception;

class InsufficientBalanceException extends Exception
{
    public function __construct(
        float $requestedAmount,
        float $currentBalance,
        int $code = 0,
        \Throwable $previous = null
    ) {
        $message = "Saldo insuficiente. Saldo do produto: $requestedAmount, Saldo atual: $currentBalance.";
        parent::__construct($message, $code, $previous);
    }
}
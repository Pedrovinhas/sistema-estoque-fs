<?php

namespace Core\Exceptions;

use Exception;

class InsufficientBalanceException extends Exception
{
    protected float $requestedAmount;
    protected float $currentBalance;

    public function __construct(
        float $requestedAmount,
        float $currentBalance,
        int $code = 0,
        \Throwable $previous = null
    ) {
        $this->requestedAmount = $requestedAmount;
        $this->currentBalance = $currentBalance;
        $message = "Saldo insuficiente. Saldo do produto: $requestedAmount, Saldo atual: $currentBalance.";
        parent::__construct($message, $code, $previous);
    }

    public function getRequestedAmount(): float
    {
        return $this->requestedAmount;
    }

    public function getCurrentBalance(): float
    {
        return $this->currentBalance;
    }
}
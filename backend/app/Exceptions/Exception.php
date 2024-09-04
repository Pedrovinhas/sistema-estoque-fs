<?php

namespace App\Exceptions;

use Exception as BaseException;

use Throwable;

abstract class Exception extends BaseException
{
    protected function __construct(
        protected string $errorCode,
        protected string $type,
        string $message,
        protected array|null $details = null,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, previous: $previous);
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function appendDetail($detail)
    {
        if (!$this->hasDetails()) {
            $this->details = [];
        }

        $this->details[] = $detail;

        return $this;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function getType()
    {
        return $this->type;
    }

    public function hasDetails()
    {
        return !is_null($this->details) && filled($this->details);
    }
}

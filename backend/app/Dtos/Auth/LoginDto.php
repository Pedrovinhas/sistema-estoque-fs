<?php

namespace App\Dtos\Auth;

class LoginDto
{
    public function __construct(
        public readonly string $email,
        public readonly string $password
    ) {}

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
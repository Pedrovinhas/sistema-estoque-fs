<?php

namespace App\Http\Requests\Auth;

use App\Dtos\Auth\LoginDto;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "email"    => 'required|min:3',
            "password" => 'required|string',
        ];
    }

    public function getCredentials()
    {
        return new LoginDto(
            $this->post('email'),
            $this->post('password')
        );
    }
}

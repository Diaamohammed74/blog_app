<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class RegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ];
    }
    public function attributes(): array
    {
        return [
            'name'             => __('main.attributes.name'),
            'email'            => __('main.attributes.email'),
            'password'         => __('main.attributes.password'),
            'confirm_password' => __('main.attributes.confirm_password'),
        ];
    }
}

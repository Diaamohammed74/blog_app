<?php

namespace App\Http\Requests;

use App\Http\Traits\ApiResponse;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

class FormRequest extends BaseFormRequest
{
    use ApiResponse;
    public function authorize(): bool
    {
        return true;
    }
}
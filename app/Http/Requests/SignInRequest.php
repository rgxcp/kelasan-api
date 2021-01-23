<?php

namespace App\Http\Requests;

use App\Http\Traits\FailedFormValidation;
use Illuminate\Foundation\Http\FormRequest;

class SignInRequest extends FormRequest
{
    use FailedFormValidation;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
                'string'
            ]
        ];
    }
}

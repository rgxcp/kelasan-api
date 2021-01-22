<?php

namespace App\Http\Requests;

class SignUpRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => [
                'required',
                'string',
                'max:30'
            ],
            'email' => [
                'required',
                'email',
                'max:50',
                'unique:users,email'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'different:email'
            ]
        ];
    }
}

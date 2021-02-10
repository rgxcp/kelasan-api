<?php

namespace App\Http\Requests;

use App\Http\Traits\FailedFormValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'current_password' => [
                'bail',
                'required',
                'string',
                'min:8',
                'max:72',
                'password:sanctum'
            ],
            'new_password' => [
                'required',
                'string',
                'min:8',
                'max:72',
                'different:current_password'
            ],
            'confirm_password' => [
                'required',
                'string',
                'min:8',
                'max:72',
                'same:new_password'
            ]
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function () {
            $this->merge([
                'password' => $this->confirm_password
            ]);
        });
    }
}

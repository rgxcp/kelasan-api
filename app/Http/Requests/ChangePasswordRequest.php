<?php

namespace App\Http\Requests;

use App\Http\Traits\FailedFormValidation;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'new_password' => [
                'required',
                'string',
                'min:8'
            ],
            'confirm_password' => [
                'required',
                'string',
                'min:8',
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

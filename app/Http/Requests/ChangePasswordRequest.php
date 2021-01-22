<?php

namespace App\Http\Requests;

class ChangePasswordRequest extends APIFormRequest
{
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

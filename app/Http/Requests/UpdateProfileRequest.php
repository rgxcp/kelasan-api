<?php

namespace App\Http\Requests;

use App\Http\Traits\FailedFormValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'full_name' => [
                'required',
                'string',
                'max:30'
            ],
            'email' => [
                'required',
                'email',
                'max:50',
                'unique:users,email,' . $this->user()->id
            ]
        ];
    }
}

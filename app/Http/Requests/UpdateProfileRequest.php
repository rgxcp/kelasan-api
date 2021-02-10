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
                'filled',
                'string',
                'max:30'
            ],
            'email' => [
                'filled',
                'email',
                'max:50',
                'unique:users,email,' . $this->user()->id
            ]
        ];
    }
}

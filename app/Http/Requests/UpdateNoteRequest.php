<?php

namespace App\Http\Requests;

use App\Http\Traits\FailedFormValidation;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNoteRequest extends FormRequest
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
            'detail' => [
                'required',
                'string'
            ]
        ];
    }
}

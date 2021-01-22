<?php

namespace App\Http\Requests;

class UpdateNoteRequest extends APIFormRequest
{
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

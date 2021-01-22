<?php

namespace App\Http\Requests;

class RenameClassroomRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:20'
            ]
        ];
    }
}

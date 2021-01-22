<?php

namespace App\Http\Requests;

class JoinClassroomRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'invitation_code' => [
                'required',
                'string',
                'min:12',
                'max:12',
                'exists:classrooms,invitation_code'
            ]
        ];
    }
}

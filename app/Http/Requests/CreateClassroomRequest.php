<?php

namespace App\Http\Requests;

use App\Http\Traits\InvitationCode;

class CreateClassroomRequest extends APIFormRequest
{
    use InvitationCode;

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

    public function messages()
    {
        return [
            //
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function () {
            $this->merge([
                'leader' => $this->user()->id,
                'invitation_code' => $this->generateInvitationCode()
            ]);
        });
    }
}

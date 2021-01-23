<?php

namespace App\Http\Requests;

use App\Http\Traits\FailedFormValidation;
use App\Http\Traits\InvitationCode;
use Illuminate\Foundation\Http\FormRequest;

class CreateClassroomRequest extends FormRequest
{
    use FailedFormValidation, InvitationCode;

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

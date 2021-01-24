<?php

namespace App\Http\Requests;

use App\Http\Traits\FailedFormValidation;
use Illuminate\Foundation\Http\FormRequest;

class ChangeAssignmentStatusRequest extends FormRequest
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
            'state' => [
                'required',
                'string',
                'in:UNCOMPLETED,DOING,COMPLETED'
            ]
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function () {
            $this->merge([
                'classroom_id' => $this->classroom->id,
                'assignment_id' => $this->assignment->id,
                'user_id' => $this->user()->id
            ]);
        });
    }
}

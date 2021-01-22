<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateAssignmentRequest extends APIFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject_id' => [
                'required',
                'integer',
                Rule::exists('subjects', 'id')->where(function ($query) {
                    return $query->where('classroom_id', $this->classroom->id);
                })
            ],
            'detail' => [
                'required',
                'string'
            ],
            'type' => [
                'filled',
                'string',
                'in:INDIVIDUAL,GROUP'
            ],
            'start' => [
                'filled',
                'date'
            ],
            'deadline' => [
                'required_with:start',
                'filled',
                'date',
                'after:start'
            ]
        ];
    }
}

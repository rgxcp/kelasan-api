<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateAssignmentRequest extends APIFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject_id' => [
                'filled',
                'integer',
                Rule::exists('subjects', 'id')->where(function ($query) {
                    return $query->where('classroom_id', $this->classroom->id);
                })
            ],
            'detail' => [
                'filled',
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

    public function messages()
    {
        return [
            //
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CreateAssignmentRequest extends APIFormRequest
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
                'string',
                'in:INDIVIDUAL,GROUP'
            ],
            'start' => [
                'date'
            ],
            'deadline' => [
                'required_with:start',
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

    public function withValidator($validator)
    {
        $validator->after(function () {
            $this->merge([
                'classroom_id' => $this->classroom->id,
                'created_by' => $this->user()->id
            ]);
        });
    }
}

<?php

namespace App\Http\Requests;

class CreateSubjectRequest extends APIFormRequest
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
                'max:50'
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

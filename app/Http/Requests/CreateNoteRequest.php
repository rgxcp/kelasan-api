<?php

namespace App\Http\Requests;

class CreateNoteRequest extends APIFormRequest
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

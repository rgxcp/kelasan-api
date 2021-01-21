<?php

namespace App\Http\Requests;

class UpdateProfileRequest extends APIFormRequest
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
            'full_name' => [
                'required',
                'string',
                'max:30'
            ],
            'email' => [
                'required',
                'email',
                'max:50',
                'unique:users,email,' . $this->user()->id
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

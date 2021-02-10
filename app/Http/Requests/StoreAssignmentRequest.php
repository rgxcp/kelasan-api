<?php

namespace App\Http\Requests;

use App\Http\Traits\FailedFormValidation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAssignmentRequest extends FormRequest
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
            'subject_id' => [
                'required',
                'integer',
                Rule::exists('subjects', 'id')->where(function ($query) {
                    return $query->where([
                        'classroom_id' => $this->classroom->id,
                        'deleted_at' => null
                    ]);
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
            ],
            'images' => [
                'filled',
                'array',
                'max:3'
            ],
            'images.*' => [
                'filled',
                'image',
                'max:3072',
                'distinct'
            ]
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function () {
            $this->merge([
                'user_id' => $this->user()->id
            ]);
        });
    }
}

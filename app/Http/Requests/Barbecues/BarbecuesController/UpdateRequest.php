<?php

namespace App\Http\Requests\Barbecues\BarbecuesController;

use App\Exceptions\ApiValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'integer',
                'exists:barbecues,id'
            ],
            'title' => [
                'required',
                'string'
            ],
            'date' => [
                'required',
                'date',
                'after_or_equal:now'
            ],
            'value_with_drink' => [
                'required',
                'numeric',
                'min:0'
            ],
            'value_without_drink' => [
                'required',
                'numeric',
                'min:0'
            ],
            'description' => [
                'sometimes',
                'string',
                'nullable'
            ],
            'users' => [
                'required',
                'array',
                'min:1'
            ],
            'users.*.id' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'users.*.with_drink' => [
                'required',
                'boolean'
            ],
            'users.*.paid' => [
                'required',
                'boolean'
            ]
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'description' => $this->input('description', null),
            'id' => $this->route('barbecue_id')
        ]);
    }

    public function failedValidation(Validator $validator): void
    {
        throw new ApiValidationException($validator->errors()->first(), $validator->errors());
    }
}

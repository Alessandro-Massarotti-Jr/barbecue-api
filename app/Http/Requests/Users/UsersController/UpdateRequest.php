<?php

namespace App\Http\Requests\Users\UsersController;

use App\Exceptions\ApiValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
                'exists:users,id'
            ],
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique('users', 'email')->whereNot('id', $this->route('user_id'))
            ],
            'password' => [
                'sometimes',
                'nullable',
                'string',
                'confirmed',
                'min:8'
            ]
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('user_id'),
            'password' => $this->input('password', null),
            'password_confirmation' => $this->input('password_confirmation', null)
        ]);
    }

    public function failedValidation(Validator $validator): void
    {
        throw new ApiValidationException($validator->errors()->first(), $validator->errors());
    }
}

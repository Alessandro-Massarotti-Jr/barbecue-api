<?php

namespace App\Http\Requests\Auth\AuthController;

use App\Exceptions\ApiValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'email' => [
                'string',
                'email',
                'required',
                'exists:users,email'
            ],
            'password' => [
                'string',
                'required',
                'min:8'
            ],
        ];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new ApiValidationException($validator->errors()->first(), $validator->errors());
    }
}

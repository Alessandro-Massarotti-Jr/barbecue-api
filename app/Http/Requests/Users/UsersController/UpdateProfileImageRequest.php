<?php

namespace App\Http\Requests\Users\UsersController;

use App\Exceptions\ApiValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileImageRequest extends FormRequest
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
            'profile_image' => [
                'sometimes',
                'nullable',
                'image'
            ]
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('user_id'),
            'profile_image' => $this->input('profile_image', null)
        ]);
    }

    public function failedValidation(Validator $validator): void
    {
        throw new ApiValidationException($validator->errors()->first(), $validator->errors());
    }
}

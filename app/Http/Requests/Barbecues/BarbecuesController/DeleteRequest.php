<?php

namespace App\Http\Requests\Barbecues\BarbecuesController;

use App\Exceptions\ApiValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
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
            ]
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('barbecue_id'),
        ]);
    }

    public function failedValidation(Validator $validator): void
    {
        throw new ApiValidationException($validator->errors()->first(), $validator->errors());
    }
}

<?php

namespace App\Http\Requests\President;

use Illuminate\Foundation\Http\FormRequest;

class FarmerRequest extends FormRequest
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
            'fullname'          => 'required',
            'contact_number'    => 'required',
            'photo'             => 'nullable|sometimes|image'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'The farmer\'s fullname field is required.'
        ];
    }
}

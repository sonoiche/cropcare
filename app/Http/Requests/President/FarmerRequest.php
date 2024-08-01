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
            'fname'             => 'required',
            'lname'             => 'required',
            'contact_number'    => 'required',
            'photo'             => 'nullable|sometimes|image'
        ];
    }

    public function messages()
    {
        return [
            'fname.required'    => 'The first name field is required.',
            'lname.required'    => 'The last name field is required.'
        ];
    }
}

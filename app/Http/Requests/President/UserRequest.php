<?php

namespace App\Http\Requests\President;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->input('id');
        return [
            'fname'             => 'required',
            'lname'             => 'required',
            'email'             => 'required|email|unique:users,email,'. (($id) ? $id : null).',id',
            'contact_number'    => 'required',
            'password'          => 'sometimes|nullable|min:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'fname.required' => 'First name field is required',
            'lname.required' => 'Last name field is required'
        ];
    }
}

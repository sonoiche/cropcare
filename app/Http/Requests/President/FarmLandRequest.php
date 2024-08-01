<?php

namespace App\Http\Requests\President;

use Illuminate\Foundation\Http\FormRequest;

class FarmLandRequest extends FormRequest
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
            'farmer_id'     => 'required',
            'location'      => 'required',
            'lat'           => 'required',
            'lng'           => 'required'
        ];
    }

    public function messages()
    {
        return [
            'farmer_id.required'        => 'The farmer field is required.',
            'location.required'         => 'The location field is required.',
            'lat'                       => 'The latitude field is required.',
            'lng'                       => 'The longitude field is required.'
        ];
    }
}

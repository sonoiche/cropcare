<?php

namespace App\Http\Requests\President;

use Illuminate\Foundation\Http\FormRequest;

class GisRequest extends FormRequest
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
            'name'          => 'required',
            'farm_area'     => 'required',
            'description'   => 'required',
            'location'      => 'required',
            'latitude'      => 'required|regex:/^[0-9\.]+$/',
            'longitude'     => 'required|regex:/^[0-9\.]+$/'
        ];
    }

    public function messages()
    {
        return [
            'farmer_id.required'     => 'The farmer\'s name field is required.'
        ];
    }
}

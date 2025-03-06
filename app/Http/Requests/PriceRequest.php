<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PriceRequest extends FormRequest
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
            'name' => 'required',
            'Price' => 'required|numeric',
            'duration' => 'required',
            'features' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required',
            'Price.required' => 'The price field is required',
            'duration.required' => 'The duration field is required',
            'features.required' => 'The features field is required',
            'numeric.Price' => 'The price must written in number'
        ];
    }
}

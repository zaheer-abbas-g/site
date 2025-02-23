<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutClient extends FormRequest
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

        $id = $this->route('admin_client');

        return [
            'name' => 'required',
            'image' => $id ?  'nullable|image|mimes:png,jpg,jpeg' : 'required|image|mimes:png,jpg,jpeg',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The client name is required',
            'image.required' => 'The client image is required'
        ];
    }
}

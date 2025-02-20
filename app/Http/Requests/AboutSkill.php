<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutSkill extends FormRequest
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
        $rules = [
            'name' => 'required',
            'skill_percentage' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'name.required' => 'The skill field is required',
            'skill_percentage.required' => 'The skill percentage field is required',
        ];

        return $messages;
    }
}

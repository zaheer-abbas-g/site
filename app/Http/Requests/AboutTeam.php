<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutTeam extends FormRequest
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
        $id = $this->route('admin_team');
        return [
            'team_description' => 'required',
            'name' => 'required',
            'designation' => 'required',
            'image' =>  $id ? 'nullable|image|mimes:jpg,jpeg,png|max:1024' : 'required|image|mimes:jpg,jpeg,png|max:1024',
        ];
    }

    public function messages()
    {

        return [
            'team_description.required' => 'Please provide team a description for team',
            'name.required' => 'The name field is required and must be string',
            'designation.required' => 'The designation field is required and must be string',
            'image' =>  [
                'required' => 'Please upload image',
                'mimes' => 'File type must be jpg png or jpeg',
                'size' => 'File size must be less than 1mb',
            ]
        ];
    }
}

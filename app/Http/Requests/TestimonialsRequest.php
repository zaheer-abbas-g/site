<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestimonialsRequest extends FormRequest
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
        $id = $this->route('admin_testimonial');
        return [
            'name'              => 'required',
            'designation'       => 'required',
            'long_description'  => 'required',
            'image' =>  $id ? 'nullable|image|mimes:jpg,jpeg,png|max:1024' : 'required|image|mimes:jpg,jpeg,png|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required and must be string',
            'designation.required' => 'The designation field is required and must be string',
            'long_description.required' => 'Please provide testimonials a description for testimonials',
            'image' =>  [
                'required' => 'Please upload image',
                'mimes' => 'File type must be jpg png or jpeg',
                'size' => 'File size must be less than 1mb',
            ]
        ];
    }
}

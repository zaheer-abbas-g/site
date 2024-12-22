<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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

            'servicedescription' => 'required',
            'serviceicon'        => 'required',
            'servicetitle'       => 'required',
            'longdescription'    => 'required',
            'featureicon'        => 'required',
            'featuretitle'       => 'required',
            'featuredescription' => 'required',
        ];
    }

    public function messages()
    {

        return [
            'servicedescription' => 'The service short description is required',
            'serviceicon' => 'The service icon is required',
            'servicetitle' => 'The service title is required',
            'longdescription' => 'The service long description is required',
            'featureicon' => 'The feature icon is required',
            'featuretitle' => 'The feature title is required',
            'featuredescription' => 'The feature description is required',
        ];
    }
}

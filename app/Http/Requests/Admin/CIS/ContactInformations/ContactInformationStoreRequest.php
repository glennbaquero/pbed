<?php

namespace App\Http\Requests\Admin\CIS\ContactInformations;

use Illuminate\Foundation\Http\FormRequest;

class ContactInformationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'confidentiality_ids' => 'required',
        ];
    }

    public function messages() {
        return [
            'category_id.required' => 'Please select category.',
            'confidentiality_ids.required' => 'Please select confidentiality.',
        ];
    }
}

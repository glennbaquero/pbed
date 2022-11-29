<?php

namespace App\Http\Requests\Admin\CMS\Procurements;

use Illuminate\Foundation\Http\FormRequest;

class ProcurementStoreRequest extends FormRequest
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
        $id = $this->route('id');

        $rules = [
            'cfp_no' => 'required',
            'title' => 'required',
            'description' => 'required',
            'file_path' => $id ? 'mimes:pdf' : 'required|mimes:pdf',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'cfp_no.required' => 'CFP Number is required.',
            'file_path.required' => 'File is required.'
        ];
    }
}

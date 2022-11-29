<?php

namespace App\Http\Requests\Admin\CMS\Careers;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\Varchar;

class CareerStoreRequest extends FormRequest
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
            'name' => ['required', new Varchar],
            'reference_no' => ['required', new Varchar],
            'type' => 'required',
            'position' => 'required',
            'description' => 'required',
            'job_expiry' => 'required',
            'downloadable_file' => $id ? 'mimes:pdf' : 'required|mimes:pdf',
        ];

        return $rules;
    }
}

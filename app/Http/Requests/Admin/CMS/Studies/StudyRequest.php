<?php

namespace App\Http\Requests\Admin\CMS\Studies;

use Illuminate\Foundation\Http\FormRequest;

class StudyRequest extends FormRequest
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
        $required = 'required';

        if($id) {
            $required = 'nullable';
        }

        $posts = [
            'name' => 'required|unique:studies,name,' .$id,
            'description' => 'required',
            'downloadable_file' => $required.'|mimes:pdf,doc,docx'
        ];

        return $posts;
    }
}

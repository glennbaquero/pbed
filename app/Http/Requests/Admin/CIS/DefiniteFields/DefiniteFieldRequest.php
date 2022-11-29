<?php

namespace App\Http\Requests\Admin\CIS\DefiniteFields;

use Illuminate\Foundation\Http\FormRequest;

class DefiniteFieldRequest extends FormRequest
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
    public function rules(){

        $posts = [
            'fieldName.*' => 'required',
        ];

        return $posts;
    }

    public function messages() {
        return [
            'fieldName.*.required' => 'Please enter field label.',
        ];
    }
}

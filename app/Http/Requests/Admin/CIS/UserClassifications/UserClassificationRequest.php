<?php

namespace App\Http\Requests\Admin\CIS\UserClassifications;

use Illuminate\Foundation\Http\FormRequest;

class UserClassificationRequest extends FormRequest
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
            'name' => 'required',
            'category_ids' => 'required'
        ];

        return $posts;
    }

    public function messages() {
        return [
            'category_ids.required' => 'Please select classification access.',
        ];
    }
}

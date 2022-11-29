<?php

namespace App\Http\Requests\Admin\CMS\YouthWorks;

use Illuminate\Foundation\Http\FormRequest;

class YouthWorksCourseRequest extends FormRequest
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
        $posts = [

            'course' => 'required',
            'site' => 'required',
            'link' => 'required',

        ];

        return $posts;
    }
}

<?php

namespace App\Http\Requests\Admin\CMS\Blogs;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            $required = '';
        }

        $posts = [
            'name' => 'required',
            'author' => 'required',
            'content' => 'required',
            'image_path' => $required . '|image',
        ];

        return $posts;
    }


    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        $messages = [
            'image_path.required' => 'Image is required',
            'image_path.image' => 'Image must be in image format'
        ];

        return $messages;
    }

}

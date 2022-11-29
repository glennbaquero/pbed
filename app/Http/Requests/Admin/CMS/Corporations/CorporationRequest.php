<?php

namespace App\Http\Requests\Admin\CMS\Corporations;

use Illuminate\Foundation\Http\FormRequest;

class CorporationRequest extends FormRequest
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
            'name' => 'required|unique:corporations,name,' .$id,
            'image_path' => $required . '|image'
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
            'image_path.required' => 'Corporation image is required',
            'image_path.image' => 'Corporation image must be in image format',
        ];

        return $messages;
    }

}

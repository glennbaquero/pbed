<?php

namespace App\Http\Requests\Admin\CMS\Projects;

use Illuminate\Foundation\Http\FormRequest;

class MilestoneRequest extends FormRequest
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
        $image = 'image';

        if($id) {
            $image = 'image';
        }

        $posts = [
            'name' => 'required',
            'description' => 'required',
            'image_path' => $image
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
            'image_path.required' => 'Milestone image is required',
            'image_path.image' => 'Milestone image must be in image format'            
        ];

        return $messages;
    }
}

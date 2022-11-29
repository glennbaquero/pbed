<?php

namespace App\Http\Requests\Admin\CMS\FrameFour;

use Illuminate\Foundation\Http\FormRequest;

class FrameFourStoreRequest extends FormRequest
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
            'name' => 'required',
            // 'label' => 'required',
            // 'data' => 'required',
            // 'bgcolor' => 'required',
            // 'first_header' => 'required',
            // 'first_content' => 'required'
        ];
    }

    public function messages() 
    {
        return [
            'name.required' => 'The title field is required.',
            // 'bgcolor.required' => 'The background color is required.',
            // 'first_header.required' => 'The first heading is required.',
            // 'first_content.required' => 'The content is required.'
        ];
    }
}

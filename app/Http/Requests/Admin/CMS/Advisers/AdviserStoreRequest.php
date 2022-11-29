<?php

namespace App\Http\Requests\Admin\CMS\Advisers;

use Illuminate\Foundation\Http\FormRequest;

class AdviserStoreRequest extends FormRequest
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

        return [
            'prefix' => 'required',
            'name' => 'required',
            'main_position' => 'required',
            'company' => 'required',
            'image_path' => $required
        ];
    }

    public function messages()
    {
        return [
            'image_path.required' => 'Image is required.'
        ];
    }
}

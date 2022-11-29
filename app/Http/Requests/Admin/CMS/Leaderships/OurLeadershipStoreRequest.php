<?php

namespace App\Http\Requests\Admin\CMS\Leaderships;

use Illuminate\Foundation\Http\FormRequest;

class OurLeadershipStoreRequest extends FormRequest
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
        $required = '';

        if($id) {
            $required = '';
        }

        return [
            'prefix' => 'required',
            'name' => 'required',
            'position' => 'required',
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

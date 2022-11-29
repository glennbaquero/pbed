<?php

namespace App\Http\Requests\Admin\CMS\Events;

use Illuminate\Foundation\Http\FormRequest;

class EventStoreRequest extends FormRequest
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

        $rules = [
            'name' => 'required',
            'content' => 'required',
            'image_path' => $id ? '' : 'required',
        ];

        return $rules;
    }

    public function message() 
    {
        return [
            'image_path.required' => 'Image is required.'
        ];
    }
}

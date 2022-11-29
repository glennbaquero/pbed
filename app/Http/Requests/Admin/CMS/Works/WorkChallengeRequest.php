<?php

namespace App\Http\Requests\Admin\CMS\Works;

use Illuminate\Foundation\Http\FormRequest;

class WorkChallengeRequest extends FormRequest
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
            'name' => 'required',
            'items.*.name' => 'required',
            'items.*.graphs.*.label' => 'required',
            'items.*.graphs.*.value' => 'required|numeric'
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
            'items.*.name.required' => 'Item name is required',
            'items.*.graphs.*.label.required' => 'Item graphs label is required',
            'items.*.graphs.*.value.required' => 'Item graphs value is required',
            'items.*.graphs.*.value.numeric' => 'Item graphs value must be in number format',
        ];


        return $messages;
    }
}

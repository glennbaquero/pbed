<?php

namespace App\Http\Requests\Admin\CMS\Challenges;

use Illuminate\Foundation\Http\FormRequest;

class ChallengeStoreRequest extends FormRequest
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
            'title' => 'required',
            // 'label' => 'required',
            // 'data' => 'required',
            // 'bgcolor' => 'required'
        ];
    }

    public function messages()
    {
        return [
            // 'bgcolor.required' => 'The background color is required.'
        ];
    }
}

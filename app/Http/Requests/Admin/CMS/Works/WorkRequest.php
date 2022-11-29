<?php

namespace App\Http\Requests\Admin\CMS\Works;

use Illuminate\Foundation\Http\FormRequest;

class WorkRequest extends FormRequest
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

        $posts = [
            'name' => 'required|unique:works,name,' .$id,
        ];

        return $posts;
    }
}

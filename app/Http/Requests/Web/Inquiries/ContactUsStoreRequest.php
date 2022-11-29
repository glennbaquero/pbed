<?php

namespace App\Http\Requests\Web\Inquiries;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsStoreRequest extends FormRequest
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
            'email' => 'required',
            'contact_number' => 'required|regex:/^(9)(\d+)$/|size:10',
            'message' => 'required',
        ];
    }
}

<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\Name;
use App\Rules\Email;
use App\Rules\Gender;
use App\Rules\Username;
use App\Rules\Image;
use App\Rules\Date;
use App\Rules\TelephoneNumber;
use App\Rules\MobileNumber;

class UserStoreRequest extends FormRequest
{
    protected $id;

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
        $this->id = $this->route('id');

        return $this->getRules();
    }

    public function messages()
    {
        return [
            'birthday.required' => 'The birthday is an invalid date',
            'birthday.after' => 'The birthday is an invalid date',
            'user_classification_ids.required' => 'The user classification is required.'
        ];
    }

    protected function getRules() {
        return [
            'name' => ['required'],
            'position' => ['required'],
            'status' => ['required'],
            'user_classification_ids' => ['required'],
            'email' => ['required', new Email('users', $this->id)],
            'image_path' => ['nullable', new Image],
        ];
    }
}

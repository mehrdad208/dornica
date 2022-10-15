<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class updateUserRequest extends FormRequest
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
            'first_name' => 'required|max:120|min:1|regex:/^[ا-یء-ي ]+$/u',
            'last_name' => 'required|max:120|min:1|regex:/^[ا-یء-ي ]+$/u',
            'national_code' => 'digits:10|unique:users,national_code,' . $this->user->id,
            'mobile' => 'digits:11|unique:users,mobile,' . $this->user->id,

        ];
    }
}

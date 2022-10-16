<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return [
                'first_name' => 'required|max:120|min:1|regex:/^[ا-یء-ي ]+$/u',
                'last_name' => 'required|max:120|min:1|regex:/^[ا-یء-ي ]+$/u',
                'national_code' => 'required|digits:10|unique:users',
                'user_name' => 'required|max:120|min:1|regex:/^[^0-9][a-zA-Z0-9 ]+$/u|unique:users',
                'mobile' => 'required|digits:11|unique:users',
                'status' => 'required|in:0,1',
                'sexuality' => 'required|in:0,1',
                'email' => 'required|string|email|unique:users',
                'soldiering_status' => 'in:0,1',
                'birthday_date' => ' required',
                'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
                'province' => 'required|exists:province_cities,id',
                'small_province' => 'required|exists:province_cities,id',
                'status' => 'required|in:0,1'

            ];
        } else {
            return [
                'first_name' => 'required|max:120|min:1|regex:/^[ا-یء-ي ]+$/u',
                'last_name' => 'required|max:120|min:1|regex:/^[ا-یء-ي ]+$/u',
                'national_code' => 'digits:10|unique:users,national_code,' . $this->user->id,
                'user_name' => 'max:120|min:1|regex:/^[^0-9][a-zA-Z0-9 ]+$/u|unique:users,user_name,' . $this->user->id,
                'mobile' => 'digits:11|unique:users,mobile,' . $this->user->id,
                'status' => 'required|in:0,1',
                'sexuality' => 'required|in:0,1',
                'email' => 'string|email|unique:users,email,' . $this->user->id,
                'soldiering_status' => 'in:0,1',
                'image' => 'image|mimes:png,jpg,jpeg,gif|max:204800',
                'birthday_date' => ' required',
                'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
                'province' => 'required|exists:province_cities,id',
                'small_province' => 'required|exists:province_cities,id',

            ];
        }
    }
}

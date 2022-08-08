<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array
     */
    public function rules()
    {
        return [
            'user_name' => ['required','string','max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:user'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
            'arabic_fullName' => ['required', 'string'],
            'english_fullName' => ['nullable', 'string'],
            'user_type_id' => ['nullable', 'string'],
            'mobile' => ['required', 'string'],
            'expiry_date' => ['nullable', 'string'],
            'active' => ['nullable', 'string'],
            'last_login' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'Password must contain at least one number, both uppercase and lowercase letters and symbol.',
        ];
    }

}

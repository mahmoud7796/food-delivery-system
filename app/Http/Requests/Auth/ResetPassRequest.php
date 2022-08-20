<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPassRequest extends FormRequest
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
            'password' => ['required', 'string', 'min:8', 'confirmed','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'],
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'يجب أن تحتوي كلمة المرور على رقم واحد على الأقل ، بأحرف كبيرة وصغيرة ورمز.',
            'password.required'=>'يرجي ادخال كلمة المرور',
            'password.min' => ' كلمة المرور  يجب الا تقل عن 8 احرف',
            'password_confirmation.confirmed' => ' كلمة المرور  غير مطابقة',


        ];
    }
}

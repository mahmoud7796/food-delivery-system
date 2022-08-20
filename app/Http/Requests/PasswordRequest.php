<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class passwordRequest extends FormRequest
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
            'current_password'  => 'required',
            'password_confirmation'  => 'required|min:8|confirmed',
            'password'  => 'required|min:8'
        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'يرجي ادخال كلمة المرور الحالية',

            'password.required' => 'يرجي ادخال كلمة المرور الجديدة',
            'password.min' => ' كلمة المرور الجديدة يجب الا تقل عن 8 احرف',
            'password_confirmation.required' => 'يرجي تاكيد كلمة المرور الجديدة',
            'password_confirmation.min' => ' كلمة المرور الجديدة يجب الا تقل عن 8 احرف',
            'password_confirmation.confirmed' => ' كلمة المرور الجديدة غير مطابقة',
            'password.confirmed' => ' كلمة المرور الجديدة غير مطابقة',



        ];
    }

}

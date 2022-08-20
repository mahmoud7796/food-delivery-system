<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class profileRequest extends FormRequest
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
            'email' => 'required|email|unique:admins,email,'.$this -> id,
            //'password'  => 'nullable|confirmed|min:8'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يرجي ادخال اسم المشرف',
            'name.string'=>'اسم القسم الفرعي لابد ان يكون نص',

            'email.required' => 'يرجي ادخال بريد الكتروني',
            'email.email' => 'هذا الحقل لابد ان يكون بريد الكتروني ',
            'email.unique' => 'هذا البريد الالكتروني مستخدم من قبل ',


        ];
    }





}

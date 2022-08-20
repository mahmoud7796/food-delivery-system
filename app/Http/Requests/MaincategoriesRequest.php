<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaincategoriesRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'photo' => 'required_without:id|mimes:jpg,jpeg,png'


        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'يرجي ادخال اسم القسم الرئيسي',
            'name.string'=>'اسم القسم الرئيسي لابد ان يكون نص',
            'name.max'=>'اسم القسم الرئيسي لابد ان لايزيد عن 100 حرف',
            'photo.required' => 'يرجي تحميل صورة القسم الرئيسي',
            'photo.mimes'=>'يرجي ان تكون الصورة من صيغة jpg او jpeg او png'

        ];
    }

}

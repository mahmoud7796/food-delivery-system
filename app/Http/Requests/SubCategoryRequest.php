<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'main_category_id' => 'required|exists:categories,id',
            ];
    }


    public function messages()
    {
        return [
            'name.required' => 'يرجي ادخال اسم القسم الفرعي',
            'name.string'=>'اسم القسم الفرعي لابد ان يكون نص',
            'name.max'=>'اسم القسم الفرعي لابد ان لايزيد عن 100 حرف',
            'main_category_id.required' => 'يرجي اختيار قسم رئيسي',
            'main_category_id.exists' => 'عفوا القسم الرئيسي الزي ادخلتة غير مدرج لدينا',

        ];
    }




}

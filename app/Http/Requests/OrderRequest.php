<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderRequest extends FormRequest
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
        return [
           'customer_email'=>'required|email',
            'customer_name'=>'required',
            'customer_country'=>'required',
            'customer_phone'=>'required|min:12|max:12',
            'customer_address'=>'required',
            'customer_city'=>'required',
            'shipping_cost'=>'nullable',
        ];
    }




    public function messages()
    {
        return [
            "customer_email.required" => "  البريد الالكتروني للعميل مطلوب",
            "customer_email.mail" => "يجب أن يكون البريد الالكتروني في صيغة بريد ",
            "customer_name.required" => "اسم العميل مطلوب ",
            "customer_country.required" => "دولة العميل مطلوبة ",
            "customer_phone.required" => "هاتف العميل مطلوب ",
            "customer_address.required" => "عنوان العميل مطلوب ",
            "customer_city.required" => "مدينة العميل مطلوبة ",
            "phone.max" => "يجب أن يكون رقم الجوال 12 رقم",
            "phone.min" => "يجب أن يكون رقم الجوال 12 رقم",






        ];
    }








    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'status' => false,
                    'message' => $validator->errors()->first(),
                    'data' => null
                ],
                400
            )
        );
    }

    protected function failedAuthorization()
    {
        throw new HttpResponseException(
            response()->json(
                [
                    'status' => false,
                    'message' => "Error: you are not authorized or do not have the permission",
                    'data' => null
                ],
                401
            )
        );
    }











}

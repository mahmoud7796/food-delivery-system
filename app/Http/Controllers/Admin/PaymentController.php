<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //

    public function index(){

        $payments = Payment::paginate(PAGINATION_COUMT);
        return view('admin.payments.index',compact('payments'));

    }


    public function create(){
        return view('admin.payments.create');
    }

    public function store(Request $request){


        $data = $request->validate([
            'name'=>'required|max:191|min:3',
            'shipping_cost'=>'required|regex:/^\d+(\.\d{1,2})?$/',

        ] ,
            [
                'name.required'=>'يرجي ادخال اسم تلك وسيلة التوصيل',
                'name.max'=>'اسم تلك وسيلة التوصي يجب الا تزيد عن 191 حرف',
                'name.min'=>'اسم تلك وسيلة التوصيل يجب الا تقل عن 3 حرف',
                'shipping_cost.required'=>'يجب ادخال سعر وسيلة التوصيل ',
                'shipping_cost.regex'=>'يجب ادخال سعر',

            ]);
        try {

            Payment::create($data);


            return redirect()->route('admin.payments')->with(['success'=>'تم الإضافة بنجاح']);

        }catch (\Exception $e){
            //return $e;
            return redirect()->route('admin.payments')->with(['error'=>'حاول فيما بعد']);
        }

    }
    public function edit($id){
        try {
            $payment = Payment::find($id);
            if(!$payment){
                return redirect()->route('admin.payments')->with(['error'=>'تلك طريقة التوصيل غير موجود']);
            }
            return view('admin.payments.edit', compact('payment'));
        }catch (\Exception $ex){
            // return $ex;
            return redirect()->route('admin.payments')->with(['error'=>'حاول فيما بعد']);

        }

    }

    public function update(Request $request,$id){
        $data = $request->validate([
            'name'=>'required|max:191|min:3',
            'shipping_cost'=>'required|regex:/^\d+(\.\d{1,2})?$/',

        ],
        [
            'name.required'=>'يرجي ادخال اسم تلك وسيلة التوصيل',
            'name.max'=>'اسم تلك وسيلة التوصي يجب الا تزيد عن 191 حرف',
            'name.min'=>'اسم تلك وسيلة التوصيل يجب الا تقل عن 3 حرف',
            'shipping_cost.required'=>'يجب ادخال سعر وسيلة التوصيل ',
            'shipping_cost.regex'=>'يجب ادخال سعر',

        ]

        );

        try {

            $payment = Payment::find($id);
            if(!$payment)
                return redirect()->route('admin.payments')->with(['error'=>'تلك طريقة التوصيل غير موجود']);


            $payment->update($data);

            return redirect()->route('admin.payments')->with(['success'=>'تم التحديث بنجاح']);

        }catch (\Exception $ex){
            //  return $ex;
            return redirect()->route('admin.payments')->with(['error'=>'حاول فيما بعد']);
        }

    }
    public function delete($id){
        try{
            $payment = Payment::find($id);
            if(!$payment)
                return redirect()->route('admin.payments')->with(['error'=>'هذا المنتج غير موجود']);

            $payment->delete();
            return redirect()->route('admin.payments')->with(['success'=>'تم الحذف']);

        }catch (\Exception $ex){
            // return $ex;
            return redirect()->route('admin.payments')->with(['error'=>'حاول فيما بعد']);


        }
    }







}

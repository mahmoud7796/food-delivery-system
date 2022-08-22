<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaincategoriesRequest;
use App\Models\category;
use App\Models\Order;
use DB;
use Illuminate\Http\Request;


class OrderController extends Controller
{

    public function index(){

        $orders = Order::orderBy('id','DESC')->paginate(PAGINATION_COUMT);
        return view('admin.orders.index',compact('orders'));
    }

    public function create(){
        return view('admin.orders.create');
    }

    public function store(Request $request){
        return  $request;
        try {
          $path = saveImage($request->photo,'categories');
          category::create([
              'name' => $request->name,
              'photo' => $path,
          ]);
            return redirect()->route('admin.maincategories')->with(['success'=>'تم الإضافة بنجاح']);

        }catch (\Exception $e){
            //return $e;
            return redirect()->route('admin.maincategories')->with(['error'=>'حاول فيما بعد']);
        }

    }
    public function edit($id){
        try {
            $mainCategory = category::orderBy('id', 'DESC')->find($id);
            if(!$mainCategory){
                return redirect()->route('admin.maincategories')->with(['error'=>'هذا القسم غير موجود']);
            }
            return view('admin.categories.edit', compact('mainCategory'));
        }catch (\Exception $ex){
           // return $ex;
            return redirect()->route('admin.maincategories')->with(['error'=>'حاول فيما بعد']);

        }

    }

    public function update(MaincategoriesRequest $request,$id){
        try {

            $category = category::find($id);
            if(!$category)
                return redirect()->route('admin.maincategories')->with(['error'=>'هذا القسم غير موجود']);
            if($request->photo)
            {
                $path= public_path().$category->photo;
                unlink($path);
                $path = saveImage($request->photo,'categories');
                $category->update([
                    'photo' => $path,
                ]);
            }
            $category->update([
                'name' => $request->name,
            ]);
            return redirect()->route('admin.maincategories')->with(['success'=>'تم التحديث بنجاح']);

        }catch (\Exception $ex){
            return $ex;
            return redirect()->route('admin.maincategories')->with(['error'=>'حاول فيما بعد']);
        }

    }
    public function delete($id){
        try{
            $order = Order::orderBy('id', 'DESC')->find($id);
            if(!$order)
                return redirect()->route('admin.orders')->with(['error'=>'هذا الطلب غير موجود']);

            $order->delete();
            return redirect()->route('admin.orders')->with(['success'=>'تم الحذف']);

        }catch (\Exception $ex){
//            return $ex;
            return redirect()->route('admin.orders')->with(['error'=>'حاول فيما بعد']);


        }
    }



    public function changeStatus(Request $request,$id){
        $order=Order::findOrFail($id);
        $order->status=$request->status;
        $order->save();
        return redirect()->route('admin.orders');
    }

}

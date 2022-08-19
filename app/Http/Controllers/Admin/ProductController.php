<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaincategoriesRequest;
use App\Models\category;
use App\Models\Product;
use DB;
use Illuminate\Http\Request;


class ProductController extends Controller
{

    public function index(){

        $products = Product::orderBy('id','DESC')->paginate(PAGINATION_COUMT);
        return view('admin.products.index',compact('products'));

    }


    public function create(){
        return view('admin.products.create');
    }

    public function store(Request $request){


        $data = $request->validate([
                'name'=>'required|max:191|min:3',
                'subcategory_id'=>'required|exists:categories,id',
                'category_id'=>'required|exists:categories,id',
                'attributes'=>'required',
                'previous_price'=> 'required|regex:/^\d+(\.\d{1,2})?$/',
                'price'=> 'required|regex:/^\d+(\.\d{1,2})?$/',
                'details'=>'required',
                'photo' => 'required|mimes:jpg,jpeg,png'

            ]);
        try {
          $path = saveImage($request->photo,'products');

         $product= Product::create($data);
         $product->photo=$path;
         $product->save();

            return redirect()->route('admin.products')->with(['success'=>'تم الإضافة بنجاح']);

        }catch (\Exception $e){
            //return $e;
            return redirect()->route('admin.products')->with(['error'=>'حاول فيما بعد']);
        }

    }
    public function edit($id){
        try {
            $product = Product::orderBy('id', 'DESC')->find($id);
            if(!$product){
                return redirect()->route('admin.products')->with(['error'=>'هذا المنتج غير موجود']);
            }
            return view('admin.products.edit', compact('product'));
        }catch (\Exception $ex){
           // return $ex;
            return redirect()->route('admin.products')->with(['error'=>'حاول فيما بعد']);

        }

    }

    public function update(Request $request,$id){
        $data = $request->validate([
            'name'=>'required|max:191|min:3',
            'subcategory_id'=>'required|exists:categories,id',
            'category_id'=>'required|exists:categories,id',
            'attributes'=>'required',
            'previous_price'=> 'required|regex:/^\d+(\.\d{1,2})?$/',
            'price'=> 'required|regex:/^\d+(\.\d{1,2})?$/',
            'details'=>'required',
            'photo' => 'nullable|mimes:jpg,jpeg,png'

        ]);

        try {

            $product = Product::find($id);
            if(!$product)
                return redirect()->route('admin.products')->with(['error'=>'هذا المنتج غير موجود']);
            if($request->photo)
            {
                $path= public_path().$product->photo;
                unlink($path);
                $path = saveImage($request->photo,'products');
                $product->update([
                    'photo' => $path,
                ]);
            }
           $path=$product->photo;
            $product->update($data);
            $product->photo=$path;
            $product->save();
            return redirect()->route('admin.products')->with(['success'=>'تم التحديث بنجاح']);

        }catch (\Exception $ex){
      //  return $ex;
            return redirect()->route('admin.products')->with(['error'=>'حاول فيما بعد']);
        }

    }
    public function delete($id){
        try{
            $product = Product::orderBy('id', 'DESC')->find($id);
            if(!$product)
                return redirect()->route('admin.products')->with(['error'=>'هذا المنتج غير موجود']);
            if($product->photo)
            {
                $path= public_path().$product->photo;
                unlink($path);
            }
            $product->delete();
            return redirect()->route('admin.products')->with(['success'=>'تم الحذف']);

        }catch (\Exception $ex){
            return $ex;
            return redirect()->route('admin.products')->with(['error'=>'حاول فيما بعد']);


        }
    }


}

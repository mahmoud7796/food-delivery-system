<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaincategoriesRequest;
use App\Models\category;
use DB;


class CartController extends Controller
{

    public function index(){
        $categories = Category::ParentCategory()->orderBy('id','DESC')->paginate(PAGINATION_COUMT);
        return view('admin.categories.index',compact('categories'));
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function store(MaincategoriesRequest $request){
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
            $category = category::orderBy('id', 'DESC')->find($id);
            if(!$category)
                return redirect()->route('admin.maincategories')->with(['error'=>'هذا القسم غير موجود']);
            if($category->photo)
            {
                $path= public_path().$category->photo;
                unlink($path);
            }
            $category->delete();
            return redirect()->route('admin.maincategories')->with(['success'=>'تم الحذف']);

        }catch (\Exception $ex){
//            return $ex;
            return redirect()->route('admin.maincategories')->with(['error'=>'حاول فيما بعد']);


        }
    }


}

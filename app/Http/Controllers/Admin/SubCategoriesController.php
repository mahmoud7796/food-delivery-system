<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\category;
use DB;


class SubCategoriesController extends Controller
{
    public function index(){
             $subCategories=Category::with(['main'=>function ($q){
            return $q->select('id','name');
        }])->SubParentCategory()->orderBy('id','DESC')->get();
        return view('admin.subcategories.index',compact('subCategories'));
    }

    public function create(){
          $mainCategories=category::ParentCategory()->get();
        return view('admin.subcategories.create',compact('mainCategories'));
    }

    public function store(SubCategoryRequest $request){
        try {
             $path = saveImage('','')
             category::create([
                 'name'=> $request->name,
                 'parent_id'=> $request->main_category_id,
            ]);
            return redirect()->route('admin.subcategories')->with(['success'=>'تم الإضافة بنجاح']);
        }catch (\Exception $ex){
            //return $ex;
            return redirect()->route('admin.subcategories')->with(['error'=>'حاول قيما بعد']);
        }

    }
    public function edit($id){
        try {
            $subCategory = category::orderBy('id', 'DESC')->find($id);
            if(!$subCategory){
                return redirect()->route('admin.subcategories')->with(['error'=>'هذه القسم غير موجود']);
            }
            $mainCategories=category::ParentCategory()->get();
            return view('admin.subcategories.edit', compact('subCategory','mainCategories'));
        }catch (\Exception $e){

        }

    }

    public function update(SubCategoryRequest $request,$id){
        try {
            //return $request;
            $category = category::find($id);
            if(!$category)
                return redirect()->route('admin.subcategories')->with(['error'=>'هذا القسم غير موجود']);

            $category->update([
                'parent_id'=> $request->main_category_id,
                'name'=> $request->name,
            ]);
            return redirect()->route('admin.subcategories')->with(['success'=>'تم التحديث بنجاح']);

        }catch (\Exception $e){

        }

    }
    public function delete($id){
        try{
            $category = category::orderBy('id', 'DESC')->find($id);
            if(!$category)
                return redirect()->route('admin.subcategories')->with(['error'=>'هذا القسم غير موجود']);
            $category->delete();
            return redirect()->route('admin.subcategories')->with(['success'=>'تم الحذف']);

        }catch (\Exception $e){

        }
    }


}

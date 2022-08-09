<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\category;
use DB;


class SubCategoriesController extends Controller
{
    public function index(){
           $subCategories=Category::with(['mainCategories'=>function ($q){
            return $q->select('id','name');
        }])->SubParentCategory()->orderBy('id','DESC')->paginate(PAGINATION_COUMT);
        return view('admin.subcategories.index',compact('subCategories'));
    }

    public function create(){
          $mainCategories=category::ParentCategory()->get();
        return view('admin.subcategories.create',compact('mainCategories'));
    }

    public function store(SubCategoryRequest $request){
        try {
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

            $category = category::find($id);
            if(!$category)
                return redirect()->route('admin.subcategories')->with(['error'=>'هذا القسم غير موجود']);

            if(!$request->has('status'))
                $request->request->add(['status'=>0]);
            else
                $request->request->add(['status'=>1]);

            $category->update([
                'parent_id'=> $request->main_category_id,
                'slug' => $request->slug,
                'is_active' => $request->status,
            ]);
            $category->name= $request->name;
            $category->save();
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

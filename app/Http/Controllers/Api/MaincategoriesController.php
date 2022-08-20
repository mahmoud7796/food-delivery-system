<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\category;
use DB;


class MaincategoriesController extends Controller
{
    public function __construct(public ApiResponse $apiResponse){}

    public function index(){
        try
        {
            $categories = Category::ParentCategory()->orderBy('id','DESC')->get();
            return $this->apiResponse->setSuccess(__("data loaded successfully"))->setData($categories)->getJsonResponse();
        } catch (\Exception $exception)
        {
            return $this->apiResponse->setError(__($exception->getMessage()))->setData()->getJsonResponse();
        }
    }

    public function getSubCategoryOfMainCategory($subCategoryId)
    {
        try
        {
            $categories = Category::with('subCategories')->ParentCategory()->find($subCategoryId);
            $subCategoriesOfOneMainCategories = $categories->subCategories;
            return $this->apiResponse->setSuccess(__("data loaded successfully"))->setData($subCategoriesOfOneMainCategories)->getJsonResponse();
        } catch (\Exception $exception)
        {
            return $this->apiResponse->setError(__($exception->getMessage()))->setData()->getJsonResponse();
        }
    }
}

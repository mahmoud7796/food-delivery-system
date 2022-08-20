<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Auth;

class ProductController extends Controller
{
    public function __construct(public ApiResponse $apiResponse){}


    public function getProductsAndSubProductsByMainCategory($id){

        try
        {
            $mainCatWithSubCatWithProduct = Category::with(['products','subCategories.subProducts'])->parentCategory()->find($id);
              if(!$mainCatWithSubCatWithProduct)
              {
                  return $this->apiResponse->setError(__("the Category Not Found"))->setData()->getJsonResponse();
              }
            return $this->apiResponse->setSuccess(__("data loaded successfully"))->setData(new CategoryResource($mainCatWithSubCatWithProduct))->getJsonResponse();
        } catch (\Exception $exception)
        {
            return $this->apiResponse->setError(__($exception->getMessage()))->setData()->getJsonResponse();
        }
    }



}

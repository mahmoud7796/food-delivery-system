<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
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


    public function productDetails($id){
        try
        {
            $product = Product::with(['category','subcategory'])->find($id);
            if(!$product)
            {
                return $this->apiResponse->setError(__("the product Not Found"))->setData()->getJsonResponse();
            }
            return $this->apiResponse->setSuccess(__("data loaded successfully"))->setData(new ProductResource($product))->getJsonResponse();
        } catch (\Exception $exception)
        {
            return $this->apiResponse->setError(__($exception->getMessage()))->setData()->getJsonResponse();
        }
    }


}

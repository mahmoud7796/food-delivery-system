<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //

    public function __construct(public ApiResponse $apiResponse){}


    public function userCart(){

        try
        {
            $carts = Cart::where('user_id',Auth::user()->id)->get();
            if($carts->isEmpty())
            {
                return $this->apiResponse->setError('Cart is empty')->setData()->getJsonResponse();
            }
            $paymentInfo['cart']= CartResource::collection($carts);
            $paymentInfo['total'] = Cart::where('user_id',Auth::user()->id)->sum('sum');
            return $this->apiResponse->setSuccess(__("data loaded successfully"))->setData($paymentInfo)->getJsonResponse();
        } catch (\Exception $exception)
        {
            return $this->apiResponse->setError(__($exception->getMessage()))->setData()->getJsonResponse();
        }


    }


    public function deleteUserCart(){

        try
        {
            $carts = Cart::where('user_id',Auth::user()->id)->get();
            foreach ($carts as $cart){
                $cart->delete();
            }


            return $this->apiResponse->setSuccess(__("The baskets have been emptied"))->setData()->getJsonResponse();
        } catch (\Exception $exception)
        {
            return $this->apiResponse->setError(__($exception->getMessage()))->setData()->getJsonResponse();
        }


    }



    public function storeOrUpdate(CartRequest $request){


        try
        {
            $cart=Cart::where('user_id',Auth::id())->where('product_id',$request->product_id)->first();


            if ($request->quantity==0)
            {
                $cart->delete();

                $carts=Cart::with(['user','product'])->where('user_id',Auth::user()->id)->get();
                //$paymentInfo = ;
               if(count($carts)==0){

                   return $this->apiResponse->setSuccess(__("your cart is empty now "))->setData()->getJsonResponse();

               }
                return $this->apiResponse->setSuccess(__("data loaded successfully"))->setData(CartResource::collection($carts))->getJsonResponse();
            }

            $sum=(Product::find($request->product_id)->price??0)*$request->quantity;

            if(!$cart){

                Cart::create(
                    [
                        'user_id'=>Auth::user()->id,
                        'product_id'=>$request->product_id,
                        'quantity'=>$request->quantity,
                        'sum'=>$sum,

                    ]

                );
            }
            else{
             $cart->update(

                 [
                     'quantity'=>$request->quantity,
                     'sum'=>$sum,

                 ]
             );
            }

            $carts=Cart::with(['user','product'])->where('user_id',Auth::user()->id)->get();
            return $this->apiResponse->setSuccess(__("data loaded successfully"))->setData(CartResource::collection($carts))->getJsonResponse();

        } catch (\Exception $exception)
        {
            return $this->apiResponse->setError(__($exception->getMessage()))->setData()->getJsonResponse();
        }






    }


}

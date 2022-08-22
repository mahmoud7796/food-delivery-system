<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\ProductOrder;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //

    public function __construct(public ApiResponse $apiResponse){}



    public function index(){


        try
        {
            $orders = Order::where('user_id',Auth::id())->with(['productOrder.product','user'])->get();

            return $this->apiResponse->setSuccess(__("data loaded successfully"))->setData(OrderResource::collection($orders) )->getJsonResponse();
        } catch (\Exception $exception)
        {
            return $this->apiResponse->setError(__($exception->getMessage()))->setData()->getJsonResponse();
        }







    }

    public function store(OrderRequest $request) {
        try {

            $carts = Cart::where('user_id', Auth::user()->id)->get();
            if (count($carts) == 0)
                return $this->apiResponse->setError(__("Your cart is empty"))->setData()->getJsonResponse();


            $order = Order::create($request->all());
            if ($request->shipping_cost) {

                $shipping_cost = Payment::find($request->shipping_cost)->shipping_cost;
            } else {
                $shipping_cost = Payment::find(1)->shipping_cost;
            }


            foreach ($carts as $cart) {

                ProductOrder::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'amount' => $cart->quantity,
                    'price' => $cart->sum,
                ]);

            }


            $total_price = $shipping_cost + Cart::where('user_id', Auth::user()->id)->sum('sum');

            $order->update([
                'price' => Cart::where('user_id', Auth::user()->id)->sum('sum'),
                'shipping_cost' => $shipping_cost,
                'total_price' => $total_price,
                'user_id'=>Auth::user()->id??'',

            ]);

        Cart::where('user_id',Auth::user()->id)->delete();

            return $this->apiResponse->setSuccess(__("data loaded successfully"))->setData($order)->getJsonResponse();
        } catch (\Exception $exception)
        {
            return $this->apiResponse->setError(__($exception->getMessage()))->setData()->getJsonResponse();
        }





    }

}

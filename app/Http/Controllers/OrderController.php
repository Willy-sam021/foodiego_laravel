<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Order\PlaceOrderRequest;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService ){
        $this->orderService = $orderService;
    }


    public function index(){
        //$orders = Order::orderBy("id","desc")->paginate(10);
        $carts= $this->orderService->getCart();
         if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }
        return view("order.checkout",compact('carts'));
    }

    public function placeOrder(PlaceOrderRequest $request){
        $data= $request->validated();
        $orders=$this->orderService->createOrder($data);

        if(!$orders){
            return redirect()->route('checkout')->with('error', 'Error encountered when placing order');
        }

        if($orders && $data['payment_method']== 'paystack' ){
            return redirect()->route('paymentPaystack');
        }else{
            return redirect()->route('orderConfirmation');
        }



    }

    public function orderConfirmation(){
        $order= $this->orderService->getOrderCollection(session('order_id'));
        return view ('order.confirmation',['orders'=> $order]);
    }

    public function getOrders(){
        $orders= $this->orderService->fetchOrders();
        // dd($orders);
        return view ('seller.viewAllOrders',['orders'=> $orders]);

    }
}

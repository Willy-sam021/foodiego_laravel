<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryCompleteRequest;
use App\Http\Requests\DeliveryDateRequest;
use App\Services\SellerService;
use App\Services\UserService;
use App\Models\Order;
use App\Services\NotificationService;
use App\Http\Requests\Seller\SellerRegisterRequest;
use App\Models\Delivery;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class SellerController extends Controller
{
    protected $notificationService;
    public function __construct(public SellerService $sellerService, public UserService $userService){
        $this->notificationService = new NotificationService;
    }
    public function create(){
        return view('seller.sellerRegistration');
    }
    public function store(SellerRegisterRequest $request){
        $validatedData = $request->validated();
        $seller=$this->sellerService->createSeller($validatedData);
        if($seller){
            $this->notificationService->sellerRegistratioMail($seller);
            return redirect()->route('seller.dashboard')->with('success', 'Seller registered successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to register seller. Please try again.');
        }
    }

    public function getOrders(){
        $orders= $this->sellerService->fetchOrders();
        // dd($orders);
        return view ('seller.viewAllOrders',['orders'=> $orders]);

    }
//becuase of the lopping we will need to pass the collection here
    public function getOrderdetail(Order $order){

        $orders= $this->sellerService->getOrderCollection($order);

        $delivery = $order->delivery; //using the relationship model;
        return view('seller.viewOrderDetails',['orders'=>$orders, 'delivery'=> $delivery ]);
    }

    public function setDeliveryDate(DeliveryDateRequest $request, Order $order){
        $date = $request->validated();
        $res = $this->sellerService->deliveryDate($date,$order);

        if($res){
            return redirect()->back()->with('success', 'delivery date set');
        }

       return redirect()->back()->with('error', 'failed to set delivery date');
        // dd($date);
    }

    public function deliveryComplete(DeliveryCompleteRequest $request, $delivery=null){
        $validatedData = $request->validated();
        if(empty($delivery)){
            return redirect()->back()->with('error','Delivery date must have been set');
        }

        $res = $this->sellerService->deliveryComplete($validatedData, $delivery);
        if($res){
            return redirect()->back()->with('success', 'delivery Confirmation successful');
        }

        return redirect()->back()->with('error', 'delivery Confirmation failed');
        

    }
}

<?php
namespace App\Repositories;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\CartRepository;
use App\Repositories\PaymentRepository;
use App\Enums\OrderEnums;
use App\Enums\PaymentStatusEnums;
use App\Enums\PaymentMethodEnums;
use App\Models\Payment;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class OrderRepository{


    public function create($cart,$data){

        $total = collect($cart)->sum(function ($item) {
            return $item['total_price'];
        });

        try{
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'total_price' => $total,
                'shipping_address' =>$data['shipping_address'],
                'status' => OrderEnums::PENDING->value,
                'phone' => $data['phone'],
                'payment_method'=>$data['payment_method'],
                // 'payment_method'=>PaymentMethodEnums::CASH,
            ]);

            //using order item relationship to insert into it
            foreach ($cart as $item) {
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'weight'   => $item['quantity'],
                    'price'      => $item['total_price'],
                    "mini_total" => $item['quantity'] * $item['total_price']

                ]);
            }
            session(['order_id' => $order->id]);

            //session()->forget('order_id');.
            return $order;
        }catch(Exception $e){
            Log::error($e->getMessage());
        }


    }

     public function getOrderCollection($id){
        $payment = Order::where('id',$id)->get();
        return $payment;
    }

    public function findById($id){

        $order = Order::findOrFail($id);
        return $order;
    }
    public function getSingleOrder($id){
        $order =Order::findOrFail($id);
        return $order;
    }

    public function findOrderForSeller($userId){
        $sellerOrders = Order::whereHas('items.product', function ($query) use ($userId) {
        $query->where('user_id', $userId);
        })
        ->with(['user', 'items.product'])
        ->get();

        return $sellerOrders;
    }

    public function paymentUpdate($data){
        $order_id = Payment::findOrFail($data->id)->order_id;
        $order= $this->findById($order_id);
        $updated= $order->update([
            'payment_reference' => $data->payment_reference,
            'payment_status' => $data->payment_status,
        ]);

        return $updated;
    }


}
?>

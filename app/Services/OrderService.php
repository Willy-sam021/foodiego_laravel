<?php
namespace App\Services;
use App\Repositories\OrderRepository;
use App\Repositories\CartRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class OrderService{
    public function __construct(public OrderRepository $orderRepository, public CartRepository $cartRepository){

    }

    public function getCart(){
    $userId= Auth::user()->id;
       $cart= $this->cartRepository->all($userId);
       return $cart;
    }

    public function createOrder($data){
        $userId = Auth::user()->id;
        $cart = $this->cartRepository->all($userId);
        $order = $this->orderRepository->create($cart, $data);

        if(!$order){
            return false;
        }
        if ($order) {
            $this->cartRepository->deleteAllCart($userId);
        }
        return true;
    }

    public function getOrder($id){
        $order = $this->orderRepository->findById($id);
        if(!$order){
            Log::error('order not found');
            return false;
        }
        return $order;
    }
//seller fetch order
   

    public function getOrderCollection($id){
        $order = $this->orderRepository->getOrderCollection($id);
        if(!$order){
            Log::error('order not found');
            return false;
        }
        return $order;
    }

}
?>

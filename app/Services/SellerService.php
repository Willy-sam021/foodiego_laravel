<?php
namespace App\Services;

use App\Repositories\DeliveryRepository;
use App\Repositories\SellerRepository;
use App\Repositories\UserRepository;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SellerService {



    public function __construct(
        public SellerRepository $sellerRepository,
        public UserRepository $userRepository,
        public OrderRepository $orderRepository,
        public DeliveryRepository $deliveryRepo,
    )
    {

    }

    public function getAllSellers(){
        $data= $this->sellerRepository->all();
        if($data->isEmpty()){
            return [];
        }
        return $data->toArray();
    }

    public function getSellerById($id){
        $seller= $this->sellerRepository->findById($id);
       if(!$seller){
            return null;
       }
       return $seller;

    }

    public function createSeller($data){
        $user= currentAuthUser();
        $data["user_id"]= $user->id;
        $file=$data['government_nin'];
        $filename = 'FG'.'NIN'.'_'.Str::uuid(). $file->getClientOriginalExtension(); // e.g., 1722438890_image.jpg
        $data['government_nin'] = $file->storeAs('government_nin', $filename, 'public');
        DB::beginTransaction();
        try {
            $seller = $this->sellerRepository->create($data);

            if (!$seller) {
                throw new \Exception("Seller creation failed");
            }

            $this->userRepository->switchToSeller($user->id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return false; // or Log::error($e->getMessage());
        }

        return $seller;
    }

    public function updateSeller($id,$data){
        return $this->sellerRepository->update($id, $data);
    }
    public function deleteSeller($id){
        return $this->sellerRepository->delete($id);
    }

     public function fetchOrders(){
        $userId = Auth::user()->id;
        $orders = $this->orderRepository->findOrderForSeller($userId);
        if(!$orders){
            Log::error('order not found');
            return false;
        }
        return $orders;

    }

    public function getOrderCollection($order){

        $order = $this->orderRepository->getOrderCollection($order->id);
        return $order;
    }

    public function deliveryDate($date, $order){
        $deliveryData= $this->deliveryRepo->create($date, $order);
        if(!$deliveryData){
            return false;
        }
        return $deliveryData;
    }

    public function getDeliveryDeets($order){
        // dd($order->id);
        $delivery = $this->deliveryRepo->fetchOrderDelivery($order->id);
        return $delivery;
    }

    public function deliveryComplete($data, $delivery){
        $delivery = $this->deliveryRepo->completeDelivery($data['delivery_status'], $delivery);
        return $delivery;
    }


}
?>

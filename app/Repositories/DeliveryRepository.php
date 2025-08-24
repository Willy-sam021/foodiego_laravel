<?php
namespace App\Repositories;
use App\Enums\DeliveryEnums;
use App\Models\Delivery;

class DeliveryRepository{

    public function create($date, $order){
        $delivery = Delivery::create([
            'order_id' => $order->id,
            'user_id' => $order->user_id,
            'exp_delivery_date' => $date['delivery_date'],
            'status' => DeliveryEnums::PENDING->value,
        ]);
        return $delivery;
    }

    public function findById($id){
        $delivery = Delivery::findOrFail($id);
        return $delivery;

    }

     public function update($id,$data){
        $delivery = $this->findById($id);
         if ($delivery) {
            $delivery->update($data);
            return $delivery;
        }
        return null;
    }

    public function delete($id){
        $delivery = $this->findById($id);
        if ($delivery) {
            return $delivery->delete();
        }
        return false;
    }

    public function fetchOrderDelivery($id){
        $delivery = Delivery::where('order_id',$id)->firstOrFail();;
        return $delivery;

    }

    public function completeDelivery($data, $delivery_Id){
        $delivery = $this->findById($delivery_Id);
          if ($delivery) {
            $delivery->update([
                'delivered_at'=>date('Y-m-d H:i:s', strtotime($data))
            ]);
            return $delivery;
        }
        return false;
    }
}
?>

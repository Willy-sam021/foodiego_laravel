<?php
namespace App\Services;
use App\Repositories\OrderItemRepository;
use App\Models\OrderItem;


class OrderItemService{
    public function __construct(public OrderItemRepository $orderItemRepository){
    }

    public function getOrderItem(){

    }
}
?>

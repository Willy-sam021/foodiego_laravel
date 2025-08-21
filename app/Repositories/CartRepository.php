<?php
namespace App\Repositories;
use App\Models\Cart;

class CartRepository {
    public function all($userId){
        $data= Cart::with('product')
        ->where('user_id', $userId)
        ->get();
        return $data;
    }

    public function findById($id){
        $cart = Cart::find($id);
        return $cart;
    }

    public function create($productId,$userId,$price){

        $data= Cart::create([
            "product_id"=> $productId,
            "user_id"=> $userId,
            "quantity"=> 1,
            "total_price"=>$price
        ]);
        return $data;
    }

    public function update($validatedData, $newQuantity, $newTotalPrice){
        $cart = $this->findById($validatedData['cart_id']);
        if($cart){
            $cart->update([
                "quantity"=> $newQuantity,
                "total_price"=>$newTotalPrice,
            ]);
           
            return $cart;

        }
        return null;

    }

    public function delete($validatedData){
        $cart = $this->findById($validatedData['cart_id']);
        if ($cart){
            return $cart->delete();
        }
        return false;
    }

    public function productExists($userid, $productid){
        $cart = Cart::query()
            ->where('user_id', $userid)
            ->where('product_id', $productid)
            ->first();
        return $cart ? true : false;
    }

    public function getTotalPrice($userId) {
        // return Cart::where('user_id', $userId)
        //     ->sum('total_price');
       $total_price = Cart::where('user_id', $userId)
                ->with('product') // eager load product to avoid N+1 problem
                ->get()
                ->sum(function ($cart) {
                    return $cart->quantity * $cart->product->price_per_kg;
                });

    }

    public function deleteAllCart($userId){
        return Cart::where('user_id', $userId)->delete();
    }
}
?>

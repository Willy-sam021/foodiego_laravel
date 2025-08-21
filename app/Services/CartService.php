<?php
namespace App\Services;

use App\Repositories\CartRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Log;
class CartService {
    protected $cartRepository;
    protected $productRepository;

    public function __construct(CartRepository $cartRepository , ProductRepository $productRepository) {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }

    public function getAllCarts() {
        $userId = auth()->id();
        $data= $this->cartRepository->all($userId);
        return $data;
    }

    public function getCartById($id) {
        return $this->cartRepository->findById($id);
    }

    public function createCart($request) {
        //checking if the product exists in the cart;
        $userId = auth()->id();
        $productId = $request->input('product_id');
        $checkExists = $this->checkProductExistsInCart($userId,$productId);
        if ($checkExists){
           return response()->json(['status' => 'exists']);
        }
        $prod=$this->productRepository->findById($productId);
        $price=$prod->price_per_kg;

        $cart = $this->cartRepository->create($productId,$userId,$price);
        if ($cart){
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'failed']);


    }

    public function updateCart($validatedData) {

        $newQuantity = $validatedData['quantity'];
        $newTotalPrice = $validatedData['total_price'];
        

        $updateCart= $this->cartRepository->update($validatedData,$newQuantity, $newTotalPrice);
        if($updateCart){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'failed']);
        }
    }

    public function deleteCart($validatedData) {

        $deleteCart= $this->cartRepository->delete($validatedData);
        if($deleteCart){
            return response()->json(['status'=> 'success']);
        }else{
            return response()->json(['status'=> 'failed']);
        }
    }

    public function checkProductExistsInCart($userId, $productId) {
        return $this->cartRepository->productExists($userId, $productId);
    }

    public function getTotalPrice() {
        $userId = auth()->id();
        return $this->cartRepository->getTotalPrice($userId);
    }
}
?>

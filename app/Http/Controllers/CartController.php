<?php

namespace App\Http\Controllers;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService) {
        $this->cartService = $cartService;
    }


    public function index(){
        $carts= $this->cartService->getAllCarts();
        $totalPrice = $this->cartService->getTotalPrice();

        return view("order.cart",compact('carts','totalPrice'));
    }

    public function add(Request $request){
        $response = $this->cartService->createCart($request);
        return $response;
    }

    public function updateQuantity(Request $request){
        $validatedData = $request->validate([
        'cart_id' => 'required|exists:carts,id',
        'quantity' => 'required|integer|min:1',
        'total_price' => 'required|numeric',
        ]);

        $cart= $this->cartService->updateCart($validatedData);
        return $cart;
    }

    public function deleteCart(Request $request){
        $validatedData = $request->validate([
        'cart_id' => 'required|exists:carts,id',
        ]);

        $cart = $this->cartService->deleteCart($validatedData);
        return $cart;
    }


}

<?php

namespace App\Http\Controllers;
use App\Services\SellerService;
use App\Services\UserService;
use App\Services\NotificationService;
use App\Http\Requests\Seller\SellerRegisterRequest;
use Illuminate\Http\Request;

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
}

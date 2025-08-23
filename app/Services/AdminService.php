<?php
namespace App\Services;
use App\Repositories\AdminRepository;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\UserRepository;



class AdminService{
    public function __construct(
        public AdminRepository $adminRepo,
        public UserRepository $userRepo,
        public OrderRepository $orderRepo,
    )
    {

    }



    public function createAdmin($data){
        $data['password']= Hash::make($data['password']);
        $admin = $this->adminRepo->create($data);
        if($admin){
            return $admin ;
        }
        return false;
    }

    public function loginAdmin($data){
         if (Auth::guard('admin')->attempt($data)) {
            return true;

        }

        return false;
    }

    public function getAllBuyers(){
        $allUsers = $this->userRepo->Buyers();
        return $allUsers;
    }


    public function getAllSellers(){
        $allUsers = $this->userRepo->Sellers();
        return $allUsers;
    }

    public function findOrderForSeller($user){
        $allOrders = $this->orderRepo->findOrderForSeller($user->id);
        return $allOrders;
    }

    public function getOrderCollection($order){
        $allOrders = $this->orderRepo->getOrderCollection($order->id);
        return $allOrders;
    }

    public function deleteUser($user){
        $deletedUser = $this->userRepo->delete($user);
        return $deletedUser;
    }

    public function allOrders(){
        $orders = $this->orderRepo->all();
        return $orders;
    }


}
?>

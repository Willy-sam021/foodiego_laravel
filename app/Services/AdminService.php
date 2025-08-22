<?php
namespace App\Services;
use App\Repositories\AdminRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminService{
    public function __construct(public AdminRepository $adminRepo )
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


}
?>

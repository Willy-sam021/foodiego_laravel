<?php

namespace App\Http\Controllers;
use App\Services\AdminService;
use App\Models\User;
use Illuminate\Support\Facades\Password;


use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function __construct(public AdminService $adminService){

    }

    public function index(){
        return view('admin.auth.register');
    }

    public function create(){
        return view('admin.auth.login');
    }

    public function createAdmin(Request $request){
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email', 'unique:admins,email'],
            'password'=> ['required','confirmed','min:8']
        ]);
        $admin= $this->adminService->createAdmin($data);
        if($admin){
            return redirect()->route('adminLoginPage');
        }

        return redirect()->back();

    }

    public function login(Request $request){
         $data = $request->validate([
            'email' => ['required','email'],
            'password'=> ['required','min:8']
         ]);
        $admin= $this->adminService->loginAdmin($data);
        if($admin){
            //dd(currentAuthUser());
            return redirect()->route('adminDashBoard');
        }

         return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);

    }

    public function viewDashboard(){
        return view('admin.adminDashboard');
    }

    public function getAllBuyers(){
        $buyers = $this->adminService->getAllBuyers();
        return view('admin.viewAllBuyers',compact('buyers'));
    }
    public function getAllSellers(){
        $sellers = $this->adminService->getAllSellers();
        return view('admin.viewAllSellers',compact('sellers'));
    }

    public function userDetail(User $user){
        $allOrders = $this->adminService->getOrderCollection($user);
        return view('admin.viewSellerDetails',['seller'=>$user,'orders'=>$allOrders]);
    }

    public function deleteUser(User $user){
        $delete = $this->adminService->deleteUser($user);
        if($delete){
            return redirect()->back()->with('success', 'Delete successful');
        }else{
            return redirect()->back()->with('error', 'Failed to Delete ');
        }
    }



}

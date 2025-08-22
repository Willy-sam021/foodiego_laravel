<?php

namespace App\Http\Controllers;
use App\Services\AdminService;
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
}

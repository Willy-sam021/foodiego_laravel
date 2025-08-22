<?php
namespace App\Repositories;
use App\Models\Admin;

class AdminRepository{

    public function all($userId){
        $data= Admin::where('user_id', $userId)->get();
        return $data;
    }

    public function findById($id){
        $admin = Admin::find($id);
        return $admin;
    }

    public function create($data){

        $admin= Admin::create($data);
        return $admin;
    }

    public function update($validatedData, $newQuantity, $newTotalPrice){
        $admin = $this->findById($validatedData['cart_id']);
        if($admin){
            $admin->update([
                "quantity"=> $newQuantity,
                "total_price"=>$newTotalPrice,
            ]);

            return $admin;

        }
        return null;

    }

    public function delete($id){
        $admin = $this->findById($id);
        if ($admin){
            return $admin->delete();
        }

        return false;
    }

}
?>

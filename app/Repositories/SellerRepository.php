<?php
namespace App\Repositories;
use App\Models\Seller;

class SellerRepository implements IRepository{

    public function all(){
        $data= Seller::all();
        return $data;
    }

    public function findById($id){
        $seller = Seller::find($id);
        return $seller;
    }

    public function create($data){
        $seller = Seller::create($data);
        return $seller;
    }
    public function update($id,$data){
        $seller = $this->findById($id);
         if ($seller) {
            $seller->update($data);
            return $seller;
        }
        return null;
    }
    public function delete($id){
        $seller = $this->findById($id);
        if ($seller) {
            return $seller->delete();
        }
        return false;
    }
}
?>

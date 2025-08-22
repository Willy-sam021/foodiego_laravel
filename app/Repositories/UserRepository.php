<?php
namespace App\Repositories;
use App\Models\User;

class UserRepository implements IRepository {

    public function all(){
        $data= User::all();
        return $data;
    }

    public function Buyers(){
       $buyers = User::buyer()->get();
       return $buyers;

    }

    public function Sellers(){
       $sellers = User::allsellers()->get();
       return $sellers;

    }

    public function findById($id){
        $user = User::find($id);
        return $user;
    }

    public function create($data){
        $user = User::create($data);
        return $user;
    }
    public function update($id,$data){
        $user = $this->findById($id);
         if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }
    public function delete($user){

        return $user->delete();

    }

    public function switchToSeller($id){
        $user = User::where('id', $id)->update([
            'is_seller'=> true
        ]);
        return $user;

    }

}
?>

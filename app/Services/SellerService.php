<?php
namespace App\Services;
use App\Repositories\SellerRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SellerService {

    protected $sellerRepository;

    public function __construct(SellerRepository $sellerRepository, public UserRepository $userRepository) {
        $this->sellerRepository = $sellerRepository;
    }

    public function getAllSellers(){
        $data= $this->sellerRepository->all();
        if($data->isEmpty()){
            return [];
        }
        return $data->toArray();
    }

    public function getSellerById($id){
        $seller= $this->sellerRepository->findById($id);
       if(!$seller){
            return null;
       }
       return $seller;

    }

    public function createSeller($data){
        $user= currentAuthUser();
        $data["user_id"]= $user->id;
        $file=$data['government_nin'];
        $filename = 'FG'.'NIN'.'_'.Str::uuid(). $file->getClientOriginalExtension(); // e.g., 1722438890_image.jpg
        $data['government_nin'] = $file->storeAs('government_nin', $filename, 'public');
        DB::beginTransaction();
        try {
            $seller = $this->sellerRepository->create($data);

            if (!$seller) {
                throw new \Exception("Seller creation failed");
            }

            $this->userRepository->switchToSeller($user->id);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return false; // or Log::error($e->getMessage());
        }

        return $seller;
    }

    public function updateSeller($id,$data){
        return $this->sellerRepository->update($id, $data);
    }
    public function deleteSeller($id){
        return $this->sellerRepository->delete($id);
    }


}
?>

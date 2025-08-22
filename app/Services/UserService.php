<?php
namespace App\Services;
use App\Repositories\UserRepository;

class UserService {

    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(){
        $data = $this->userRepository->all();
        if($data->isEmpty()){
            return [];
        }
        return $data;
    }

    public function getUserById($id){
        $user = $this->userRepository->findById($id);
        if(!$user){
            return null;
        }
        return $user;
    }

    public function createUser($data){
        return $this->userRepository->create($data);

    }

    public function updateUser($id, $data){
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser($id){
        return $this->userRepository->delete($id);
    }

    public function switchToSeller($id){
        return $this->userRepository->switchToSeller($id);
    }
}
?>

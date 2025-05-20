<?php 

namespace app\Services;
use App\BusinesLogic\UserBo;

class userservice{

    protected $userbo;
    public function __construct(userbo $userbo){
        $this->userbo=$userbo;
    }

    public function getAllUser(){
       return  $this->userbo->userlist();
    }
    public function createUser(array $data){
        return $this->userbo->createUser($data);
    }

    public function updateUser(array $data,$id){
           return  $this->userbo->updateUser($data,$id);
    }

    public function deleteUser($id){
      return   $this->userbo->deleteUser($id);
    }
    public function findUserById($id){
      return  $this->userbo->findUserById($id);   
    }
}
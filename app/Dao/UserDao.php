<?php
namespace App\Dao;

use App\Models\User;

class userdao{
    public function findUserById($id){

           return user::find($id);
    }

    public function userlist(){

        return user::all()->toArray();
    
    }

    public function createUser($data)
    {
        return user::create($data);
    }

    public function updateUser($data,$id)
    {     $user=  user::find($id);
        // dd($data);
        if($user){

             $user->update($data);
        }
        return $user;
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
        }
        return $user;
    }
}
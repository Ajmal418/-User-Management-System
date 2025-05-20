<?php

namespace App\BusinesLogic;

use App\Dao\UserDao;
use Illuminate\support\Facades\Hash;
use Illuminate\support\Facades\Cache;
use Illuminate\support\Facades\Log;
use Exception;

class userbo
{

  protected $userquery;
  public function __construct(UserDao $userDao)
  {
    $this->userquery = $userDao;
  }

  public function userlist()
  {
    $response =  Cache::remember('userlist', 60, function () {
      return $this->userquery->userlist();
    });
    return $response;
  }

  public function createUser($data)
  {
    // $name=$request->username;
    // $email=$request->useremail;
    // $password=Hash::make($request->password);
    $userData = [
      'name' => $data['username'],
      'email' => $data['useremail'],
      'password' => Hash::make($data['password'])
    ];
    $response = $this->userquery->createUser($userData);
    Cache::flush('userlist');
    return   $response;
  }

  public  function updateUser(array $data, $id)
  {
   
      $userData = [
        'name' => $data['username'],
        'email' => $data['useremail'],

      ];
      $user = $this->userquery->findUserById($id);
      if ($user) {
        if (!hash::check($data['password'], $user->password)) {
          $password = Hash::make($data['password']);
          $userData['password'] = $password;
        };
        $response = $this->userquery->updateUser($userData, $id);
        Cache::flush('userlist');
        return  $response;
      }
   
  }
  public function deleteUser($id)
  {

    $response = $this->userquery->deleteUser($id);
    Cache::flush('userlist');
    return $response;
  }
  public function findUserById($id)
  {
    return $this->userquery->findUserById($id);
  }
}

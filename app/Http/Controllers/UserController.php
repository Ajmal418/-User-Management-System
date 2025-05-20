<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use App\Services\userservice;
use Illuminate\support\Facades\Log;
use App\Models\User;
use Exception;

class UserController extends Controller
{
    protected $userservice;
    public function __construct(UserService $userservice)
    {
        $this->userservice = $userservice;
    }

    public function index()
    {
        return view('form');
    }

    public function edit()
    {
        return view('form');
    }

    public function userListView()
    {
        // $users= $this->userservice->getAllUser();
        // dd($users);
        return view('userlist');
    }

    public function registration(UserRequest $request)
    {
        try {
            $res = $this->userservice->createUser($request->all());
            if ($res) {
                Cache::flush('userlist');
                return response()->json(['success' => true, 'message' => 'user created successfully'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'something went wrong'], 400);
            }
        } catch (Exception $ex) {
            Log::error('User creation', [
                'error' => $ex->getMessage(),
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Internal Server Error',
                ],
                500,
            );
        }
    }

    public function userList()
    {
        try {
            $users = $this->userservice->getAllUser();
            return response()->json(['success' => true, 'message' => 'user list', 'data' => $users], 200);
        } catch (Exception $ex) {
            Log::error('User list', [
                'error' => $ex->getMessage(),
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Internal Server Error',
                ],
                500,
            );
        }
    }

    public function userDetails($id)
    {
        try {
            
            $response = $this->userservice->findUserById($id);
            if ($response) {
                return response()->json(['success' => true, 'message' => 'user details', 'data' => $response], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'your not not found'], 400);
            }
        } catch (Exception $ex) {
            Log::error('User details', [
                'error' => $ex->getMessage(),
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Internal Server Error',
                ],
                500,
            );
        }
    }

    public function userUpdate(UserRequest $request, $id)
    {
        try {
            $response = $this->userservice->updateUser($request->all(), $id);
            if ($response) {
                return response()->json(['success' => true, 'message' => 'user updated successfully'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'something went wrong'], 400);
            }
        } catch (Exception $ex) {
            Log::error('User updation failed', [
                'error' => $ex->getMessage(),
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Internal Server Error',
                ],
                500,
            );
        }
    }

    public function userDelete($id)
    {
        try {
           
            $destroy = $this->userservice->deleteUser($id);
            if ($destroy) {
                return response()->json(['success' => true, 'message' => 'User Delete Succesfully'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'something went wrong'], 400);
            }
        } catch (Exception $ex) {
            Log::error('User delete', [
                'error' => $ex->getMessage(),
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Internal Server Error',
                ],
                500,
            );
        }
    }
}

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('registration',[UserController::class,'registration']);
Route::get('/userlist',[UserController::class,'userList']);
Route::get('/userdetails/{id}', [UserController::class, 'userDetails']);
Route::put('/userupdate/{id}', [UserController::class, 'userUpdate']);
Route::delete('/userdelete/{id}', [UserController::class, 'userDelete']);
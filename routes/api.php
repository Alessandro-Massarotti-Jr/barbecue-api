<?php

use App\Helpers\ReturnApi;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function (Request $request) {
    return ReturnApi::success("App running");
});

Route::prefix('/users')->group(function () {
    Route::get('/', [UsersController::class, 'get']);
    Route::post('/', [UsersController::class, 'create']);
    Route::post('/{user_id}/update-profile-image', [UsersController::class, 'updateProfileImage']);
    Route::get('/{user_id}', [UsersController::class, 'find']);
    Route::put('/{user_id}', [UsersController::class, 'update']);
    Route::delete('/{user_id}', [UsersController::class, 'delete']);
});

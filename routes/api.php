<?php

use App\Helpers\ReturnApi;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Barbecues\BarbecuesController;
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


Route::prefix('auth')->middleware('auth.api')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/login', [AuthController::class, 'login'])->withoutMiddleware('auth.api');
});


Route::prefix('/users')->middleware('auth.api')->group(function () {
    Route::get('/', [UsersController::class, 'get']);
    Route::post('/', [UsersController::class, 'create'])->withoutMiddleware('auth.api');
    Route::post('/{user_id}/update-profile-image', [UsersController::class, 'updateProfileImage']);
    Route::get('/{user_id}', [UsersController::class, 'find']);
    Route::put('/{user_id}', [UsersController::class, 'update']);
    Route::delete('/{user_id}', [UsersController::class, 'delete']);
});

Route::prefix('/barbecues')->middleware('auth.api')->group(function () {
    Route::get('/', [BarbecuesController::class, 'get']);
    Route::post('/', [BarbecuesController::class, 'create']);
    Route::get('/{barbecue_id}', [BarbecuesController::class, 'find']);
    Route::put('/{barbecue_id}', [BarbecuesController::class, 'update']);
    Route::delete('/{barbecue_id}', [BarbecuesController::class, 'delete']);
});

<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ApiException;
use App\Helpers\ReturnApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthController\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {

        if (!$token = auth('api')->attempt($request->validated())) {
            throw new ApiException("Usuário ou senha incorretos", 401);
        }

        return ReturnApi::success("Login success", [
            'user' => User::with(['ownerBarbecues', 'barbecues'])->find(auth('api')->user()->id),
            'token' => $token
        ]);
    }


    public function logout()
    {
        auth('api')->logout();

        return ReturnApi::success("Logout succefull");
    }

    public function me()
    {
        return ReturnApi::success("Auth user data", User::with(['ownerBarbecues', 'barbecues'])->find(Auth::id()));
    }
}

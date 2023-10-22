<?php

namespace App\Http\Controllers\Users;

use App\Helpers\ReturnApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UsersController\CreateRequest;
use App\Http\Requests\Users\UsersController\DeleteRequest;
use App\Http\Requests\Users\UsersController\FindRequest;
use App\Http\Requests\Users\UsersController\UpdateProfileImageRequest;
use App\Http\Requests\Users\UsersController\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function create(CreateRequest $request)
    {
        $data = $request->validated();
        return ReturnApi::success("User created succeful", User::create([
            'name' => $data['name'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            'profile_image_path' => $data['profile_image'] ?  $data['profile_image']->store('public/users') : null
        ]), 201);
    }
    public function find(FindRequest $request)
    {
        return ReturnApi::success("User Found", User::with(['ownerBarbecues', 'barbecues'])->find($request->validated()['id']));
    }
    public function update(UpdateRequest $request)
    {
        $data = $request->validated();
        $user = User::with(['ownerBarbecues', 'barbecues'])->find($data['id']);
        $user->name = $data['name'];
        $user->email = $data['email'];
        if ($data['password']) {
            $user->password = Hash::make($data['password']);
        }
        $user->update();
        return ReturnApi::success("User updated", $user);
    }

    public function updateProfileImage(UpdateProfileImageRequest $request)
    {
        $data = $request->validated();
        $user = User::with(['ownerBarbecues', 'barbecues'])->find($data['id']);
        if ($user->profile_image_path) {
            Storage::delete($user->profile_image_path);
        }

        $user->profile_image_path = $data['profile_image'] ? $data['profile_image']->store('public/users') : null;
        $user->update();
        return ReturnApi::success("User profile image updated", $user);
    }

    public function delete(DeleteRequest $request)
    {
        return ReturnApi::success("User deleted", User::with(['ownerBarbecues', 'barbecues'])->find($request->validated()['id'])->delete());
    }
    public function get()
    {
        return ReturnApi::success("All users", User::with(['ownerBarbecues', 'barbecues'])->get());
    }
}

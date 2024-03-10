<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list()
    {
        return User::all();
    }

    public function listById(int $id)
    {
        return User::findOrFail($id);
    }

    public function add(UserRequest $req)
    {
        $data = $req->all();
        $data['password'] = bcrypt($req->password);
        return User::create($data);
    }

    public function edit(UserRequest $req, int $id)
    {
        $user = User::findOrFail($id);
        $data = $req->all();
        $user->update($data);
        return $user;
    }

    public function destroy(int $id)
    {
        $clinic = User::findOrFail($id);
        $clinic->delete();
        return response()->json(['message'=>'User deleted with success'], 200);
    }
}

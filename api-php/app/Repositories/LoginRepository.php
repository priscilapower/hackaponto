<?php

namespace App\Repositories;

use App\Http\Requests\LoginRequest;
use App\User;
use Elasticsearch\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRepository
{

    public function login(LoginRequest $request)
    {
        $user = User::where('usuario','=',$request->usuario)->select('id','nome', 'usuario', 'email', 'password')->first();
        if(Hash::check($request->password, $user->password)) {
            return $user;
        }
        return false;
    }

}


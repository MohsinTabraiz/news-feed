<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Traits\HttpResponsesTrait;
use App\Http\Traits\TokenTrait;

class LoginController extends Controller
{
    use HttpResponsesTrait, TokenTrait;

    public function notLoggedInError(){
        return $this->error('','Please SignIn/SignUp first', 401);
    }

    public function login(LoginRequest $request){

        if(!Auth::attempt($request->only(['email', 'password']))){
            return $this->error('','Credentials do not match', 401);
        }

        $user = User::where('email', $request->email)->first();

        return $this->success([
            'user' => $user,
            'token' => $this->generateToken($user),
        ]);
    }    
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Traits\HttpResponsesTrait;
use App\Http\Traits\TokenTrait;

class RegisterController extends Controller
{
    use TokenTrait;
    use HttpResponsesTrait;
    
    public function register(RegisterRequest $request){
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('Auth Token '. $user->name)->plainTextToken,
        ]);
    }
}

<?php

namespace App\Http\Traits;

use App\Models\User;

trait TokenTrait
{
    private function generateToken(User $user)
    {
        return $user->createToken('Auth Token ' . $user->name)->plainTextToken;
    }
}
<?php

namespace App\Services;

use App\Models\Entity;
use App\Exceptions\Errors;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(string $email, string $password)
    {
        $user = Entity::where('email', $email)->first();

        if (!$user || ! Hash::check($password, $user->password)) {
            return null;
        }

        return $user;
    }

    public function logout($user)
    {
        $user->currentAccessToken()->delete();
        return ['message' => 'Logged out successfully'];
    }
}

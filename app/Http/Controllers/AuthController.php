<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\EntityResource;
use App\Notifications\LoginNotification;
use App\Notifications\LogoutNotification;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $user = $this->authService->login($request->email, $request->password);
        if (!$user) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user->notify(new LoginNotification($user));

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user) {
        $user->notify(new LogoutNotification($user)); 
        $user->tokens()->delete(); 
    }

    return response()->json(['message' => 'Logged out successfully']);
    }
}

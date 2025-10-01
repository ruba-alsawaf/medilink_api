<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\EntityResource;
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

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['token' => $token]);
    }

    public function logout(Request $request)
    {
        $user = $request->user(); 
        $user->currentAccessToken()->delete();

        if (! $user) {
            return response()->json(['message' => 'No user logged in'], 401);
        }

        $result = $this->authService->logout($user);

        return response()->json([
            'status' => 'success',
            'message' => $result['message'],
        ]);
    }
}

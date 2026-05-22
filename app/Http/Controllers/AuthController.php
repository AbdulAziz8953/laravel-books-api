<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Traits\ApiResponseTrait;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $this->success([
            'user' => $user->only(['id', 'name', 'email'])
        ], 'User registered successfully', 201);
    }

    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        
        if (!$token = JWTAuth::attempt($credentials)) {
            return $this->error('Invalid credentials', 401);
        }

        return $this->success([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => config('jwt.ttl') * 60,
            'user' => auth()->user()->only(['id', 'name', 'email'])
        ], 'Login successful');
    }

    public function profile()
    {
        return $this->success(auth()->user()->only(['id', 'name', 'email']), 'Profile fetched');
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return $this->success(null, 'Successfully logged out');
        } catch (\Exception $e) {
            return $this->error('Failed to logout', 500);
        }
    }
}
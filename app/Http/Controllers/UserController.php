<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(UserRequest $request)
    {
        $user = $this->userService->register($request->validated());
        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
        ], 201);
    }
    public function login(LoginRequest $request)
    {
        $token = $this->userService->login($request->validated());
        return response()->json($token);
    }

    public function logout()
    {
        $message = $this->userService->logout();
        return response()->json($message);
    }
}
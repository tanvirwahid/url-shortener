<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function __construct(private UserService $userService)
    {
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = $this->userService->findByEmail($request->get('email'));

            return response()->json([
                'message' => 'Successfully logged in',
                'data' => [
                    'user' => $user,
                    'authorization' => [
                        'token' => $user->createToken('ApiToken')->plainTextToken,
                        'type' => 'bearer',
                    ],
                ],
            ]);
        }

        return response()->json([
            'message' => 'Wrong email or password'
        ], Response::HTTP_UNAUTHORIZED);

    }

    public function logout()
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }
}

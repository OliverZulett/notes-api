<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  protected $userService;

  public function __construct(UserService $userService)
  {
    $this->userService = $userService;
    $this->middleware('auth:api', ['except' => ['login', 'register']]);
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|string|email',
      'password' => 'required|string',
    ]);
    $credentials = $request->only('email', 'password');

    $token = Auth::guard('api')->attempt($credentials);
    if (!$token) {
      return response()->json([
        'status' => 'error',
        'message' => 'Unauthorized',
      ], 401);
    }

    $user = Auth::guard('api')->user();
    return response()->json([
      'status' => 'success',
      'user' => $user,
      'authorization' => [
        'token' => $token,
        'type' => 'bearer',
      ]
    ]);
  }

  public function register(StoreUserRequest $userCredentials)
  {
    return new UserResource($this->userService->createUser($userCredentials));
  }

  public function logout()
  {
    Auth::guard('api')->logout();
    return response()->json([
      'status' => 'success',
      'message' => 'Successfully logged out',
    ]);
  }

  public function refresh()
  {
    return response()->json([
      'status' => 'success',
      'user' => Auth::guard('api')->user(),
      'authorization' => [
        'token' => Auth::refresh(),
        'type' => 'bearer',
      ]
    ]);
  }
}

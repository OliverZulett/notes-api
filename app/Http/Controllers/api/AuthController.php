<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  private $userService;
  private $authService;

  public function __construct(
    UserService $userService,
    AuthService $authService
  ) {
    $this->userService = $userService;
    $this->authService = $authService;
    $this->middleware('auth:api', ['except' => ['login', 'register']]);
  }

  public function login(Request $request)
  {
    $request->validate([
      'email' => 'required|string|email',
      'password' => 'required|string',
    ]);
    $credentials = $request->only('email', 'password');

    return response()->json([
      'status' => 'success',
      'data' => [
        'token' => $this->authService->login($credentials)
      ]
    ]);
  }

  public function register(StoreUserRequest $userCredentials)
  {
    return new UserResource($this->userService->createUser($userCredentials));
  }

  public function logout()
  {
    return $this->authService->logout();
  }

  public function refresh()
  {
    return $this->authService->refresh();
  }
}

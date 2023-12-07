<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\TokenResource;
use App\Services\AuthService;
use App\Services\UserService;

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

  public function login(AuthUserRequest $request)
  {
    $credentials = $request->only('email', 'password');
    return new TokenResource($this->authService->login($credentials));
  }

  public function register(StoreUserRequest $userCredentials)
  {
    $this->userService->createUser($userCredentials);
    $credentials = $userCredentials->only('email', 'password');
    return new TokenResource($this->authService->login($credentials));
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

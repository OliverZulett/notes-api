<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class AuthController extends Controller
{
  protected $userService;

  public function __construct(UserService $userService)
  {
    $this->userService = $userService;
  }

  public function register(StoreUserRequest $userCredentials)
  {
    return new UserResource($this->userService->createUser($userCredentials));
  }
}

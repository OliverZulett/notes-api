<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class AuthService
{
  public function login($credentials)
  {
    $token = Auth::guard('api')->attempt($credentials);

    if (!$token) {
      throw new UnauthorizedException('Invalid Credentials');
    }

    return $token;
  }

  public function logout()
  {
    Auth::guard('api')->logout();
  }

  public function refresh()
  {
    return Auth::refresh();
  }
}

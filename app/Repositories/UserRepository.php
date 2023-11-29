<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
  public function getAll()
  {
    return User::all();
  }

  public function create($userData)
  {
    return User::create($userData);
  }

  public function getById($userId)
  {
    return User::findOrFail($userId);
  }

  public function update($userId, $userData)
  {
    $user = $this->getById($userId);
    $user->update($userData);
    return $user;
  }

  public function delete($userId)
  {
    $user = $this->getById($userId);
    $user->delete();
  }
}

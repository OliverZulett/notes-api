<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Laravel\Prompts\Output\ConsoleOutput;
use Spatie\FlareClient\Http\Exceptions\NotFound;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class UserService
{
  protected $userRepository;

  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function getAllUsers()
  {
    return $this->userRepository->getAll();
  }

  public function createUser($user)
  {
    try {
      return $this->userRepository->create([
        'username' => $user->username,
        'email' => $user->email,
        'password' => Hash::make($user->password),
    ]);
    } catch (Exception $e) {
      throw new BadRequestException($e->getMessage());
    }
  }

  public function getUserById($userId)
  {
    try {
      return $this->userRepository->getById($userId);
    } catch (Exception $e) {
      throw new NotFoundHttpException($e->getMessage());
    }
  }

  public function updateUser($userId, $user)
  {
    try {
      $this->getUserById($userId);
      return $this->userRepository->update($userId, [
        'username' => $user->username,
        'email' => $user->email,
        'password' => Hash::make($user->password),
      ]);
    } catch (Exception $e) {
      throw new BadRequestException($e->getMessage());
    }
  }

  public function deleteUser($userId)
  {
    try {
      $this->userRepository->delete($userId);
    } catch (QueryException $e) {
      throw new InternalErrorException($e->getMessage());
    } catch (Exception $e) {
      throw new NotFoundHttpException($e->getMessage());
    }
  }
}

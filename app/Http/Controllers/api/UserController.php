<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection($this->userService->getAllUsers());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $user)
    {
        return new UserResource($this->userService->createUser($user));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $userId)
    {
        return new UserResource($this->userService->getUserById($userId));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $user, string $userId)
    {
        return new UserResource($this->userService->updateUser($userId, $user));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $userId)
    {
        return $this->userService->deleteUser($userId);
    }
}

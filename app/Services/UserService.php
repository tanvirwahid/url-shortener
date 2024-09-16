<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Dtos\UserDto;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class UserService
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {}

    public function create(UserDto $userDto): User
    {
        $user = $this->userRepository->create($userDto);
        event(new Registered($user));

        return $user;
    }

    public function findById(int $id): User
    {
        return $this->userRepository->getById($id);
    }
}

<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Dtos\UserDto;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class UserService
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function create(UserDto $userDto): User
    {
        $user = $this->userRepository->create($userDto);
        event(new Registered($user));

        return $user;
    }

    public function findByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }
}

<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Dtos\UserDto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private User $user)
    {}

    public function create(UserDto $userDto): User
    {
        return $this->user->create([
            'name' => $userDto->getName(),
            'email' => $userDto->getEmail(),
            'password' => Hash::make($userDto->getPassword()),
            'is_admin' => $userDto->isAdmin() ? 1 : 0
        ]);
    }

    public function getById(int $id): User
    {
        return $this->user->find($id);
    }

}

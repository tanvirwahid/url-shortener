<?php

namespace App\Contracts\Repositories;

use App\Dtos\UserDto;
use App\Models\User;

interface UserRepositoryInterface
{
    public function create(UserDto $userDto): User;
    public function getById(int $id): User;
    public function getTotal(): int;
    public function findByEmail(string $email): ?User;
}

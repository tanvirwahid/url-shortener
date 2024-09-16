<?php

namespace App\Dtos;

class UserDto
{
    private string $name;

    private string $email;

    private string $password;

    private bool $isAdmin = false;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): UserDto
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): UserDto
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): UserDto
    {
        $this->password = $password;

        return $this;
    }

    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): UserDto
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    public function __toString(): string
    {
        return 'name = '.$this->name.PHP_EOL.
            'email = '.$this->email.PHP_EOL.
            'is admin'.$this->isAdmin ? '1' : '0'.PHP_EOL.
            'password'.$this->password;
    }
}

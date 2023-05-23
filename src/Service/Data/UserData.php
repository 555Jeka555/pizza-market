<?php

declare(strict_types=1);
namespace App\Service\Data;

class UserData
{
    public function __construct(
        private ?int $userId,
        private string $firstName, 
        private string $secondName,
        private string $email,
        private string $password,
        private string|null $phone, 
        private string|null $avatarPath)
    {}

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getSecondName(): string
    {
        return $this->secondName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string|null
    {
        return $this->phone;
    }

    public function getAvatarPath(): string|null
    {
        return $this->avatarPath;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
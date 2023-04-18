<?php

namespace App\Model;

class User {
    private ?int $userId;
    private string $first_name;
    private string $second_name;
	private string $email;
	private int $phone;
	private string $avatar_path;

    public function __construct(?int $userId, string $first_name, string $second_name,
        string $email, int $phone, string $avatar_path)
    {
        $this->userId = $userId;
        $this->first_name = $first_name;
        $this->second_name = $second_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->avatar_path = $avatar_path;
    }

    public function getUserId(): ?int
    {
       return $this->userId;
    }

   public function getFirstName(): string
   {
        return $this->first_name;
   }

   public function getSecondName(): string
   {
       return $this->second_name;
   }

   public function getEmail(): string
    {
       return $this->email;
    }

   public function getPhone(): int
   {
        return $this->phone;
   }

   public function getAvatarPath(): string
   {
       return $this->avatar_path;
   }

}
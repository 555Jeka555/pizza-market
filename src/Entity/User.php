<?php

namespace App\Entity;

class User {
    private ?int $user_id;
    private string $first_name;
    private string $second_name;
	private string $email;
	private string|null $phone;
	private string|null $avatar_path;

    public function __construct(?int $user_id, string $first_name, string $second_name,
        string $email, string|null $phone, string|null $avatar_path)
    {
        $this->user_id = $user_id;
        $this->first_name = $first_name;
        $this->second_name = $second_name;
        $this->email = $email;
        $this->phone = $phone;
        $this->avatar_path = $avatar_path;
    }

    public function getUserId(): ?int
    {
       return $this->user_id;
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

   public function getPhone(): string|null
   {
        return $this->phone;
   }

   public function getAvatarPath(): string|null
   {
       return $this->avatar_path;
   }

}
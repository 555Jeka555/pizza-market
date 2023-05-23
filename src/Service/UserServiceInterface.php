<?php

declare(strict_types=1);
namespace App\Service;

use App\Service\Data\UserData;
use Symfony\Component\HttpFoundation\Request;

interface UserServiceInterface
{
    public function saveUser(Request $request, ?string $illustrationPath): int;
   
    public function getUser(int $userId): ?UserData;

    public function getUserByEmail(string $email): ?UserData;

    public function deleteUser(int $userId): void;

    public function listUsers(): array;
}

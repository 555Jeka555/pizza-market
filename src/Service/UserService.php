<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\Data\UserData;
use Symfony\Component\HttpFoundation\Request;
use App\Service\UserServiceInterface;

class UserService implements UserServiceInterface {

    private UserRepository $userRepository;
    private PasswordHasher $passwordHasher;

    public function __construct(UserRepository $userRepository, PasswordHasher $passwordHasher)
    {
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function saveUser(Request $request, ?string $illustrationPath): int
    {
        $user = new User(
            null, 
            $request->get("first_name"), 
            $request->get("second_name"),
            $request->get("email"),
            $request->get("phone"),
            $this->passwordHasher->hash($request->get("password")), 
            $illustrationPath
        );
        return $this->userRepository->store($user);
    }
   
    public function getUser(int $userId): ?UserData
    {
        $user = $this->userRepository->findById($userId);
        if ($user === null) 
        {
            return null;
        }
        return new UserData (
            $user->getUserId(),
            $user->getFirstName(),
            $user->getSecondName(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getPhone(),
            $user->getAvatarPath()
        );
    }

    public function getUserByEmail(string $email): ?UserData
    {
        $user = $this->userRepository->findByEmail($email);
        if ($user === null) 
        {
            return null;
        }
        return new UserData (
            $user->getUserId(),
            $user->getFirstName(),
            $user->getSecondName(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getPhone(),
            $user->getAvatarPath()
        );
    }

    public function deleteUser(int $userId): void
    {
        $user = $this->userRepository->findById($userId);
        if ($user !== null)
        {
            $this->userRepository->delete($user);
        }
    }

    public function listUsers(): array
    {
        $users = $this->userRepository->listAll();
        $usersView = [];
        foreach ($users as $user) 
        {
            $usersView[] = new UserData(
                $user->getUserId(),
                $user->getFirstName(),
                $user->getSecondName(),
                $user->getEmail(),
                $user->getPassword(),
                $user->getPhone(),
                $user->getAvatarPath(),
            );
        }

        return $usersView;
    }

}
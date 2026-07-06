<?php

namespace App\Services;

use App\Entity\User;
use App\Repository\UserRepositoryInterface;
use App\Requests\CreateUserRequest;

class CreateUserService
{
    public function __construct(
        private readonly UserRepositoryInterface $users,
    ) {
    }

    public function execute(CreateUserRequest $request): User
    {
        $user = User::create(
            $request->getFirstName(),
            $request->getLastName(),
            $request->getEmail(),
            $request->getPassword(),
            $request->getUsername()
        );

        $this->users->save($user);

        return $user;
    }
}

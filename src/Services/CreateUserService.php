<?php

namespace App\Services;

use App\Entity\Email;
use App\Entity\FirstName;
use App\Entity\LastName;
use App\Entity\Password;
use App\Entity\User;
use App\Entity\Username;
use App\Requests\CreateUserRequest;

class CreateUserService
{
    public function __construct()
    {
    }

    public function execute(CreateUserRequest $request): User
    {
        $user = User::create(
            new FirstName($request->getFirstName()),
            new LastName($request->getLastName()),
            new Email($request->getEmail()),
            new Password($request->getPassword()),
            new Username($request->getUsername())
        );

        return $user;
    }
}

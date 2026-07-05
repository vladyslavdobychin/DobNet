<?php

namespace App\Repository;

use App\Entity\Email;
use App\Entity\User;
use App\Entity\Username;

interface UserRepositoryInterface
{
    public function save(User $user): void;

    public function findByUsername(Username $username): ?User;

    public function existsByUsername(Username $username): bool;

    public function existsByEmail(Email $email): bool;
}

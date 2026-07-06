<?php

namespace App\Entity;

use InvalidArgumentException;

readonly class Password
{
    public function __construct(private string $password)
    {
        if (strlen($password) < 8) {
            throw new InvalidArgumentException('Password needs to be at least 8 characters long');
        }
    }

    public function value(): string
    {
        return $this->password;
    }
}

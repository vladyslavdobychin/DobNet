<?php

namespace App\Entity;

use InvalidArgumentException;

readonly class LastName
{
    public function __construct(private string $lastName)
    {
        if ($lastName === '') {
            throw new InvalidArgumentException('Last name cannot be empty.');
        }

        if (strlen($lastName) > 35) {
            throw new InvalidArgumentException('Last name cannot be longer than 35 characters.');
        }
    }

    public function value(): string
    {
        return $this->lastName;
    }
}
<?php

namespace App\Entity;

use InvalidArgumentException;

readonly class FirstName
{
    public function __construct(private string $firstName)
    {
        if ($firstName === '') {
            throw new InvalidArgumentException('First name cannot be empty.');
        }

        if (strlen($firstName) > 35) {
            throw new InvalidArgumentException('First name cannot be longer than 35 characters.');
        }
    }

    public function value(): string
    {
        return $this->firstName;
    }
}
<?php

namespace App\Entity;

use InvalidArgumentException;

readonly class Email
{
    private string $email;
    public function __construct(
        string $email,
    ) {
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if (!$email) {
            throw new InvalidArgumentException('Invalid email.');
        }

        $this->email = $email;
    }

    public function value(): string
    {
        return $this->email;
    }
}

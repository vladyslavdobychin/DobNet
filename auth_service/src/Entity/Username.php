<?php

namespace App\Entity;

readonly class Username
{
    public function __construct(
        private string $username
    ) {
    }

    public function value(): string
    {
        return $this->username;
    }
}
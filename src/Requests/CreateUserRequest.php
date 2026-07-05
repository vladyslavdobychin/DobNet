<?php

namespace App\Requests;

use Symfony\Component\Validator\Constraints as Assert;
readonly class CreateUserRequest
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\NotNull]
        #[Assert\Type('string')]
        private string $first_name,

        #[Assert\NotBlank]
        #[Assert\NotNull]
        #[Assert\Type('string')]
        private string $last_name,

        #[Assert\NotBlank]
        #[Assert\NotNull]
        #[Assert\Email]
        private string $email,

        #[Assert\NotBlank]
        #[Assert\NotNull]
        #[Assert\Type('string')]
        private string $password,

        #[Assert\NotBlank]
        #[Assert\NotNull]
        #[Assert\Type('string')]
        private string $username
    ) {
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'email' => $this->email,
            'password' => $this->password,
            'username' => $this->username
        ];
    }
}

<?php

namespace App\Entity;

use Symfony\Component\Uid\Uuid;

class User
{
    private Uuid $id;
    private FirstName $firstName;
    private LastName $lastName;
    private Email $email;
    private Password $password;
    private Username $username;

    private function __construct(
        ?Uuid $id,
        FirstName $firstName,
        LastName $lastName,
        Email $email,
        Password $password,
        Username $username,
    ) {
        $this->id = $id ?? Uuid::v7();
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
    }

    public static function create(
        FirstName $firstName,
        LastName $lastName,
        Email $email,
        Password $password,
        Username $username
    ): self {
        return new self(
            null,
            $firstName,
            $lastName,
            $email,
            $password,
            $username,
        );
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getFirstName(): FirstName
    {
        return $this->firstName;
    }

    public function getLastName(): LastName
    {
        return $this->lastName;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function getUsername(): Username
    {
        return $this->username;
    }
}
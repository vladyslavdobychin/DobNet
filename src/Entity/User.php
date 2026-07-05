<?php

namespace App\Entity;

use App\Entity\Email;
use App\Entity\FirstName;
use App\Entity\LastName;
use App\Entity\Password;
use App\Entity\Username;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ORM\Column(type: 'string', length: 35)]
    private string $firstName;

    #[ORM\Column(type: 'string', length: 35)]
    private string $lastName;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private string $email;

    #[ORM\Column(type: 'string')]
    private string $password;

    #[ORM\Column(type: 'string', unique: true)]
    private string $username;

    private function __construct(
        ?Uuid $id,
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $username,
    ) {
        $this->id = $id ?? Uuid::v7();
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
    }

    public static function create(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $username
    ): self {
        return new self(null, $firstName, $lastName, $email, $password, $username);
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getFirstName(): FirstName
    {
        return new FirstName($this->firstName);
    }

    public function getLastName(): LastName
    {
        return new LastName($this->lastName);
    }

    public function getEmail(): Email
    {
        return new Email($this->email);
    }

    public function getPassword(): Password
    {
        return new Password($this->password);
    }

    public function getUsername(): Username
    {
        return new Username($this->username);
    }
}

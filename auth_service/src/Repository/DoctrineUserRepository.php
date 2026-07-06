<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Username;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUserRepository implements UserRepositoryInterface
{
    public function __construct(private readonly EntityManagerInterface $em)
    {
    }

    public function save(User $user): void
    {
        $this->em->persist($user);
        $this->em->flush();
    }

    public function findByUsername(Username $username): ?User
    {
        return $this->em->getRepository(User::class)
            ->findOneBy(['username' => $username->value()]);
    }

    public function existsByUsername(Username $username): bool
    {
        return (bool) $this->em->createQueryBuilder()
            ->select('COUNT(u.id)')
            ->from(User::class, 'u')
            ->where('u.username = :username')
            ->setParameter('username', $username->value())
            ->getQuery()
            ->getSingleScalarResult();
    }
}

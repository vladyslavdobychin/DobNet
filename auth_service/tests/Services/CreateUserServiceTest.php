<?php

declare(strict_types=1);

namespace App\Tests\Services;

use App\Entity\User;
use App\Entity\Email;
use App\Entity\FirstName;
use App\Entity\LastName;
use App\Entity\Password;
use App\Entity\Username;
use App\Repository\UserRepositoryInterface;
use App\Requests\CreateUserRequest;
use App\Services\CreateUserService;
use PHPUnit\Framework\TestCase;

final class CreateUserServiceTest extends TestCase
{
    public function test_execute_creates_user_and_calls_repository_once(): void
    {
        $saved = [];

        $users = new class($saved) implements UserRepositoryInterface {
            /** @var list<User> */
            private array $saved;

            public function __construct(array &$saved) {
                $this->saved = &$saved;
            }

            public function save(User $user): void {
                $this->saved[] = $user;
            }

            public function findByUsername(Username $username): ?User {
                return null;
            }

            public function existsByUsername(Username $username): bool {
                return false;
            }
        };

        $service = new CreateUserService($users);

        $request = new CreateUserRequest(
            firstName: 'John',
            lastName: 'Doe',
            email: 'john@example.com',
            password: 'secret123',
            username: 'johnd',
        );

        $result = $service->execute($request);

        self::assertCount(1, $saved);
        self::assertSame($result, $saved[0]);
        self::assertInstanceOf(User::class, $result);

        self::assertSame('john@example.com', $result->getEmail()->value());
        self::assertSame('johnd', $result->getUsername()->value());
        self::assertSame('John', $result->getFirstName()->value());
        self::assertSame('Doe', $result->getLastName()->value());
        self::assertSame('secret123', $result->getPassword()->value());
    }
}

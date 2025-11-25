<?php

declare(strict_types=1);

namespace App\Identity\Domain\Factory;

use App\Identity\Domain\Entity\User;
use App\Identity\Domain\ValueObject\UserId;

final class UserFactory
{
    public function create(string $email, string $password): User
    {
        return new User(UserId::new(), $email, $password);
    }
}

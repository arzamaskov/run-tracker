<?php

declare(strict_types=1);

namespace App\Identity\Domain\Entity;

use App\Identity\Domain\ValueObject\UserId;

final class User
{
    public function __construct(
        private readonly UserId $id,
        private string $email,
        private string $password,
        private array $roles = ['ROLE_USER']
    ) {
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function roles(): array
    {
        return $this->roles;
    }

    public function changeEmail(string $email): void
    {
        $this->email = $email;
    }

    public function changePassword(string $password): void
    {
        $this->password = $password;
    }

    public function addRole(string $role): void
    {
        //
    }

    public function removeRole(string $role): void
    {
        //
    }

    public function hasRole(string $role): bool
    {
        return in_array($role, $this->roles);
    }
}

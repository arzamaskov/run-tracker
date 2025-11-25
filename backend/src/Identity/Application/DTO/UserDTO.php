<?php

declare(strict_types=1);

namespace App\Identity\Application\DTO;

use App\Identity\Domain\Entity\User;

final readonly class UserDTO
{
    public function __construct(public string $id, public string $email)
    {
    }

    public static function fromEntity(User $user): self
    {
        return new self($user->id()->value(), $user->email());
    }
}

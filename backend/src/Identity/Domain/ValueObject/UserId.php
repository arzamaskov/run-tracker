<?php

declare(strict_types=1);

namespace App\Identity\Domain\ValueObject;

use Symfony\Component\Uid\Uuid;

final readonly class UserId
{
    private function __construct(private Uuid $uuid)
    {
    }

    public static function new(): UserId
    {
        return new self(Uuid::v7());
    }

    public static function fromString(string $uuid): UserId
    {
        if (!Uuid::isValid($uuid)) {
            throw new \InvalidArgumentException("Invalid UUID format: $uuid");
        }

        return new UserId(Uuid::fromString($uuid));
    }

    public function value(): string
    {
        return $this->uuid->toRfc4122();
    }

    public function equals(UserId $other): bool
    {
        return $this->uuid === $other->uuid;
    }

    public function toString(): string
    {
        return $this->uuid->toString();
    }

    public function __toString(): string
    {
        return $this->toString();
    }
}

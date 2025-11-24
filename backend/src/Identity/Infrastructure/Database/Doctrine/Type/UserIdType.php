<?php

declare(strict_types=1);

namespace App\Identity\Infrastructure\Database\Doctrine\Type;

use App\Identity\Domain\ValueObject\UserId;
use App\Shared\Infrastructure\Database\Doctrine\Type\AbstractUuidType;

final class UserIdType extends AbstractUuidType
{
    protected function getValueObjectClass(): string
    {
        return UserId::class;
    }

    public function getName(): string
    {
        return 'user_id';
    }
}

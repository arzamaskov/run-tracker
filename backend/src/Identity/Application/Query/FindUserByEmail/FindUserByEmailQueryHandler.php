<?php

declare(strict_types=1);

namespace App\Identity\Application\Query\FindUserByEmail;

use App\Identity\Application\DTO\UserDTO;
use App\Identity\Domain\Port\UserRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

final readonly class FindUserByEmailQueryHandler implements QueryHandlerInterface
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function __invoke(FindUserByEmailQuery $query): UserDTO
    {
        return UserDTO::fromEntity($this->userRepository->findByEmail($query->email));
    }
}

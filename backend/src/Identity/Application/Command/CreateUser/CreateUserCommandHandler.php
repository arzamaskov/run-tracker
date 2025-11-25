<?php

declare(strict_types=1);

namespace App\Identity\Application\Command\CreateUser;

use App\Identity\Domain\Factory\UserFactory;
use App\Identity\Domain\Port\UserRepositoryInterface;
use App\Identity\Domain\ValueObject\UserId;
use App\Shared\Application\Command\CommandHandlerInterface;

final class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly UserFactory $userFactory,
    ) {
    }

    public function __invoke(CreateUserCommand $command): UserId
    {
        $user = $this->userFactory->create($command->email, $command->password);
        $this->userRepository->add($user);

        return $user->id();
    }
}

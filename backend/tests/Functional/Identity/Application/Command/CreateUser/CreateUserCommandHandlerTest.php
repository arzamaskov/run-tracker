<?php

declare(strict_types=1);

namespace App\Tests\Functional\Identity\Application\Command\CreateUser;

use App\Identity\Application\Command\CreateUser\CreateUserCommand;
use App\Identity\Domain\Port\UserRepositoryInterface;
use App\Shared\Application\Command\CommandBusInterface;
use App\Tests\Tools\FakerTools;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateUserCommandHandlerTest extends WebTestCase
{
    use FakerTools;

    private CommandBusInterface $commandBus;
    private UserRepositoryInterface $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->commandBus = static::getContainer()->get(CommandBusInterface::class);
        $this->userRepository = static::getContainer()->get(UserRepositoryInterface::class);
    }

    public function test_user_created_successfully(): void
    {
        // arrange
        $command = new CreateUserCommand($this->getFaker()->email(), $this->getFaker()->password());

        // act
        $userId = $this->commandBus->execute($command);

        // assert
        $user = $this->userRepository->findById($userId);
        self::assertNotEmpty($user);
    }
}

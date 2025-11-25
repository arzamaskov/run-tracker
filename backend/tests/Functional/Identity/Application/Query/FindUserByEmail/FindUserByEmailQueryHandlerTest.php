<?php

declare(strict_types=1);

namespace App\Tests\Functional\Identity\Application\Query\FindUserByEmail;

use App\Identity\Application\DTO\UserDTO;
use App\Identity\Application\Query\FindUserByEmail\FindUserByEmailQuery;
use App\Identity\Domain\Entity\User;
use App\Identity\Domain\Port\UserRepositoryInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Tests\Resource\Fixture\UserFixture;
use App\Tests\Tools\FakerTools;
use App\Tests\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

class FindUserByEmailQueryHandlerTest extends WebTestCase
{
    use FakerTools;

    private QueryBusInterface $queryBus;
    private UserRepositoryInterface $repository;
    private AbstractDatabaseTool $databaseTool;

    protected function setUp(): void
    {
        parent::setUp();
        $this->queryBus = $this->getService(QueryBusInterface::class);
        $this->repository = $this->getService(UserRepositoryInterface::class);
        $this->databaseTool = $this->getService(DatabaseToolCollection::class)->get();
    }

    public function test_user_found_successfully(): void
    {
        // arrange
        $this->databaseTool->loadFixtures([UserFixture::class]);
        /** @var User $user */
        $user = $this->repository->findByEmail(UserFixture::EMAIL);
        $query = new FindUserByEmailQuery($user->email());

        // act
        $userDTO = $this->queryBus->execute($query);

        // assert
        self::assertInstanceOf(UserDTO::class, $userDTO);
    }
}

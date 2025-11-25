<?php

declare(strict_types=1);

namespace App\Tests\Functional\Identity\Infrastructure\Repository;

use App\Identity\Domain\Entity\User;
use App\Identity\Domain\Factory\UserFactory;
use App\Identity\Domain\Port\UserRepositoryInterface;
use App\Identity\Infrastructure\Repository\DoctrineUserRepository;
use App\Tests\Resource\Fixture\UserFixture;
use App\Tests\Tools\FakerTools;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DoctrineUserRepositoryTest extends WebTestCase
{
    use FakerTools;

    private UserRepositoryInterface $repository;
    private UserFactory $userFactory;
    private AbstractDatabaseTool $databaseTool;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = static::getContainer()->get(DoctrineUserRepository::class);
        $this->userFactory = static::getContainer()->get(UserFactory::class);
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function test_user_added_successfully(): void
    {
        // arrange
        $email = $this->getFaker()->email();
        $password = $this->getFaker()->password();
        $user = $this->userFactory->create($email, $password);

        // act
        /** @var DoctrineUserRepository $repo */
        $repo = $this->repository;
        $repo->add($user);

        // assert
        /** @var User $existingUser */
        $existingUser = $repo->findById($user->id());
        self::assertEquals($user->id(), $existingUser->id());
    }

    public function test_user_found_by_id_successfully(): void
    {
        // arrange
        $this->databaseTool->loadFixtures([UserFixture::class]);
        /** @var DoctrineUserRepository $repo */
        $repo = $this->repository;
        $user = $repo->findByEmail(UserFixture::EMAIL);

        // act
        $existingUser = $repo->findById($user->id());

        // assert
        self::assertEquals($user->id(), $existingUser->id());
    }
}

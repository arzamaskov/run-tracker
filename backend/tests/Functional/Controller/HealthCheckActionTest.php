<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class HealthCheckActionTest extends WebTestCase
{
    public function test_request_responded_successful_result(): void
    {
        // arrange
        $client = static::createClient();

        // act
        $client->request(Request::METHOD_GET, '/healthcheck');

        // assert
        self::assertResponseIsSuccessful();
        $jsonResponse = json_decode($client->getResponse()->getContent(), true);
        self::assertEquals('OK', $jsonResponse['status']);
    }
}

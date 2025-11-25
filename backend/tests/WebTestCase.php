<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;

abstract class WebTestCase extends BaseWebTestCase
{
    /** @template T of object
     * @param class-string<T> $serviceName
     *
     * @return T
     */
    protected function getService(string $serviceName)
    {
        return static::getContainer()->get($serviceName);
    }
}

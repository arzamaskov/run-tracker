<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Database\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\GuidType;
use Doctrine\DBAL\Types\Type;

abstract class AbstractUuidType extends Type
{
    abstract protected function getValueObjectClass(): string;

    abstract public function getName(): string;

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return new GuidType()->getSQLDeclaration($column, $platform);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }

        $class = $this->getValueObjectClass();

        if ($value instanceof $class) {
            return $value->toString();
        }

        throw new ConversionException(sprintf('Could not convert PHP value "%s" of type "%s" to type "%s". Expected: null or %s', var_export($value, true), get_debug_type($value), $this->getName(), $class));
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?object
    {
        if (null === $value) {
            return null;
        }

        $class = $this->getValueObjectClass();

        try {
            return $class::fromString($value);
        } catch (\Throwable $e) {
            throw new ConversionException(sprintf('Could not convert database value "%s" to type "%s"', $value, static::class), 0, $e);
        }
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}

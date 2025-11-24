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

        throw ConversionException::conversionFailedInvalidType($value, static::class, ['null', $class]);
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
            throw ConversionException::conversionFailed($value, static::class);
        }
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }
}

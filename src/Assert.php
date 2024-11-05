<?php

declare(strict_types=1);

namespace Jlaswell\Assert;

use Jlaswell\Assert\AssertionException;

final class Assert
{
    public static function that(bool $condition): void
    {
        true === $condition ?: AssertionException::throw($condition);
    }

    public static function isTrue(mixed $value): void
    {
        true === $value ?: AssertionException::throw($value);
    }

    public static function isFalse(mixed $value): void
    {
        false === $value ?: AssertionException::throw($value);
    }
}

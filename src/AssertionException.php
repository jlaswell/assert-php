<?php

declare(strict_types=1);

namespace Jlaswell\Assert;

use RuntimeException;
use Throwable;

final class AssertionException extends RuntimeException
{
    public static function throw(mixed $value): never
    {
        throw new self('$value does not meet assertion');
    }
}

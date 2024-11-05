<?php

declare(strict_types=1);

namespace Jlaswell\Tests\Assert;

use Jlaswell\Assert\Assert;
use Jlaswell\Assert\AssertionException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use stdClass;

final class AssertTest extends TestCase
{
    public function testThatOnSuccess(): void
    {
        $this->expectNotToPerformAssertions();

        Assert::that(true);
        Assert::that(true === true);
        Assert::that(false !== true);
    }

    public function testThatOnFailure(): void
    {
        $this->expectException(AssertionException::class);
        $this->expectExceptionMessage('$value does not meet assertion');

        Assert::that(true === false);
    }

    /**
     * @return array<array<bool>>
     */
    public static function provideTrueData(): array
    {
        return [
            [true],
            [true === true],
            [true !== false],
            [gettype(new stdClass()) === 'object'],
        ];
    }

    #[DataProvider('provideTrueData')]
    public function testIsTrueOnSuccess(bool $data): void
    {
        $this->expectNotToPerformAssertions();

        Assert::isTrue($data);
    }

    /**
     * @return array<array<bool>>
     */
    public static function provideFalseData(): array
    {
        return [
            [false],
            [true !== true],
            [true === false],
            [gettype(new stdClass()) === 'int'],
        ];
    }

    #[DataProvider('provideFalseData')]
    public function isIsTrueOnFailure(bool $data): void
    {
        $this->expectException(AssertionException::class);
        $this->expectExceptionMessage('$value does not meet assertion');

        Assert::isTrue($data);
    }

    #[DataProvider('provideFalseData')] 
    public function testIsFalseOnSuccess(bool $data): void
    {
        $this->expectNotToPerformAssertions();

        Assert::isFalse($data);
    }

    #[DataProvider('provideTrueData')]
    public function testIsFalseOnFailure(bool $data): void
    {
        $this->expectException(AssertionException::class);
        $this->expectExceptionMessage('$value does not meet assertion');

        Assert::isFalse($data);
    }
}

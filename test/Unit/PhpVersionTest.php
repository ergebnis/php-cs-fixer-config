<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019-2025 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config\Test\Unit;

use Ergebnis\DataProvider;
use Ergebnis\PhpCsFixer\Config\PhpVersion;
use Ergebnis\PhpCsFixer\Config\Test;
use PHPUnit\Framework;

/**
 * @covers \Ergebnis\PhpCsFixer\Config\PhpVersion
 *
 * @uses \Ergebnis\PhpCsFixer\Config\PhpVersion\Major
 * @uses \Ergebnis\PhpCsFixer\Config\PhpVersion\Minor
 * @uses \Ergebnis\PhpCsFixer\Config\PhpVersion\Patch
 *
 * @no-named-arguments
 */
final class PhpVersionTest extends Framework\TestCase
{
    use Test\Util\Helper;

    public function testCreateReturnsPhpVersion(): void
    {
        $faker = self::faker();

        $major = PhpVersion\Major::fromInt($faker->numberBetween(0));
        $minor = PhpVersion\Minor::fromInt($faker->numberBetween(0, 99));
        $patch = PhpVersion\Patch::fromInt($faker->numberBetween(0, 99));

        $phpVersion = PhpVersion::create(
            $major,
            $minor,
            $patch,
        );

        self::assertSame($major, $phpVersion->major());
        self::assertSame($minor, $phpVersion->minor());
        self::assertSame($patch, $phpVersion->patch());

        $expected = \sprintf(
            '%d.%d.%d',
            $major->toInt(),
            $minor->toInt(),
            $patch->toInt(),
        );

        self::assertSame($expected, $phpVersion->toString());
    }

    /**
     * @dataProvider \Ergebnis\DataProvider\IntProvider::lessThanZero
     */
    public function testFromIntRejectsInvalidValue(int $value): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(\sprintf(
            'Value needs to be greater than or equal to 0, but %d is not.',
            $value,
        ));

        PhpVersion::fromInt($value);
    }

    /**
     * @dataProvider \Ergebnis\DataProvider\IntProvider::greaterThanZero
     * @dataProvider \Ergebnis\DataProvider\IntProvider::zero
     */
    public function testFromIntReturnsPhpVersion(int $value): void
    {
        $phpVersion = PhpVersion::fromInt($value);

        self::assertSame($value, $phpVersion->toInt());
    }

    public function testCurrentReturnsPhpVersion(): void
    {
        $phpVersion = PhpVersion::current();

        self::assertSame(\PHP_VERSION_ID, $phpVersion->toInt());
    }

    public function testIsSmallerThanReturnsFalseWhenValueIsGreater(): void
    {
        $one = PhpVersion::fromInt(\PHP_VERSION_ID + 1);
        $two = PhpVersion::fromInt(\PHP_VERSION_ID);

        self::assertFalse($one->isSmallerThan($two));
    }

    public function testIsSmallerThanReturnsFalseWhenValueIsSame(): void
    {
        $value = \PHP_VERSION_ID;

        $one = PhpVersion::fromInt($value);
        $two = PhpVersion::fromInt($value);

        self::assertFalse($one->isSmallerThan($two));
    }

    public function testIsSmallerThanReturnsTrueWhenValueIsSmaller(): void
    {
        $one = PhpVersion::fromInt(\PHP_VERSION_ID);
        $two = PhpVersion::fromInt(\PHP_VERSION_ID + 1);

        self::assertTrue($one->isSmallerThan($two));
    }
}

<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019-2023 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config\Test\Unit\PhpVersion;

use Ergebnis\DataProvider;
use Ergebnis\PhpCsFixer\Config\PhpVersion;
use Ergebnis\PhpCsFixer\Config\Test;
use PHPUnit\Framework;

/**
 * @covers \Ergebnis\PhpCsFixer\Config\PhpVersion\Patch
 */
final class PatchTest extends Framework\TestCase
{
    use Test\Util\Helper;

    /**
     * @dataProvider \Ergebnis\DataProvider\IntProvider::lessThanZero
     */
    public function testFromIntRejectsValueLessThanZero(int $value): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(\sprintf(
            'Value needs to be a greater than or equal to 0, but %d is not.',
            $value,
        ));

        PhpVersion\Patch::fromInt($value);
    }

    /**
     * @dataProvider provideValueGreaterThanNinetyNine
     */
    public function testFromIntRejectsValueGreaterThanNinetyNine(int $value): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(\sprintf(
            'Value needs to be a less than or equal to 99, but %d is not.',
            $value,
        ));

        PhpVersion\Patch::fromInt($value);
    }

    /**
     * @return \Generator<string, array{0: int}>
     */
    public static function provideValueGreaterThanNinetyNine(): iterable
    {
        $values = [
            'int-one-hundred' => 100,
            'int-greater-than-one-hundred' => self::faker()->numberBetween(101, 999),
        ];

        foreach ($values as $key => $value) {
            yield $key => [
                $value,
            ];
        }
    }

    /**
     * @dataProvider provideValidValue
     */
    public function testFromIntReturnsPatch(int $value): void
    {
        $patch = PhpVersion\Patch::fromInt($value);

        self::assertSame($value, $patch->toInt());
    }

    /**
     * @return \Generator<string, array{0: int}>
     */
    public static function provideValidValue(): iterable
    {
        $values = [
            'int-zero' => 0,
            'int-one' => 1,
            'int-greater-than-one-less-than-ninetynine' => self::faker()->numberBetween(1, 99),
            'int-ninetynine' => 99,
        ];

        foreach ($values as $key => $value) {
            yield $key => [
                $value,
            ];
        }
    }
}

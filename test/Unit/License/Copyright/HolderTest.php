<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019-2020 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config\Test\Unit\License\Copyright;

use Ergebnis\PhpCsFixer\Config\License\Copyright\Holder;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @covers \Ergebnis\PhpCsFixer\Config\License\Copyright\Holder
 */
final class HolderTest extends Framework\TestCase
{
    use Helper;

    /**
     * @dataProvider provideInvalidValue
     *
     * @param string $value
     */
    public function testFromStringRejectsInvalidValue(string $value): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Value cannot be blank or empty.');

        Holder::fromString($value);
    }

    public function provideInvalidValue(): \Generator
    {
        $values = [
            'string-blank' => '  ',
            'string-empty' => '',
        ];

        foreach ($values as $key => $value) {
            yield $key => [
                $value,
            ];
        }
    }

    /**
     * @dataProvider provideValidValue
     *
     * @param string $value
     */
    public function testFromStringReturnsHolder(string $value): void
    {
        $holder = Holder::fromString($value);

        self::assertSame($value, $holder->toString());
    }

    public function provideValidValue(): \Generator
    {
        foreach (self::validValues() as $key => $value) {
            yield $key => [
                $value,
            ];
        }
    }

    /**
     * @dataProvider provideUntrimmedValue
     *
     * @param string $value
     */
    public function testFromStringReturnsHolderWithTrimmedValue(string $value): void
    {
        $holder = Holder::fromString($value);

        self::assertSame(\trim($value), $holder->toString());
    }

    public function provideUntrimmedValue(): \Generator
    {
        foreach (self::validValues() as $key => $value) {
            yield $key => [
                \sprintf(
                    " %s \n\n",
                    $value
                ),
            ];
        }
    }

    private static function validValues(): array
    {
        return [
            'string-first-name' => 'Andreas',
            'string-full-name' => 'Andreas Möller',
            'string-handle' => 'localheinz',
            'string-last-name' => 'Möller',
        ];
    }
}

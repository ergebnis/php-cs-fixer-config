<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config\Test\Unit\Header;

use Ergebnis\PhpCsFixer\Config\Header\License;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @covers \Ergebnis\PhpCsFixer\Config\Header\License
 */
final class LicenseTest extends Framework\TestCase
{
    use Helper;

    /**
     * @dataProvider provideValidValue
     *
     * @param string $value
     */
    public function testFromStringReturnsLicense(string $value): void
    {
        $license = License::fromString($value);

        self::assertSame($value, $license->toString());
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
    public function testFromStringReturnsLicenseWithTrimmedValue(string $value): void
    {
        $license = License::fromString($value);

        self::assertSame(\trim($value), $license->toString());
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

    public function testIsEmptyReturnsFalseWhenTrimmedValueIsNotEmpty(): void
    {
        $license = License::fromString(self::faker()->realText());

        self::assertFalse($license->isEmpty());
    }

    /**
     * @dataProvider provideBlankOrEmptyString
     *
     * @param string $value
     */
    public function testIsEmptyReturnsTrueWhenTrimmedValueIsEmpty(string $value): void
    {
        $license = License::fromString($value);

        self::assertTrue($license->isEmpty());
    }

    public function provideBlankOrEmptyString(): \Generator
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

    private static function validValues(): array
    {
        return [
            'string-arbitrary' => self::faker()->realText(),
            'string-empty' => '',
        ];
    }
}

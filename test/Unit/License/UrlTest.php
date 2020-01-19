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

namespace Ergebnis\PhpCsFixer\Config\Test\Unit\License;

use Ergebnis\PhpCsFixer\Config\License\Url;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @covers \Ergebnis\PhpCsFixer\Config\License\Url
 */
final class UrlTest extends Framework\TestCase
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
        $this->expectExceptionMessage(\sprintf(
            'Value "%s" does not appear to be a valid URL.',
            $value
        ));

        Url::fromString($value);
    }

    public function provideInvalidValue(): \Generator
    {
        $values = [
            'string-arbitrary' => self::faker()->sentence,
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
    public function testFromStringReturnsUrl(string $value): void
    {
        $url = Url::fromString($value);

        self::assertSame($value, $url->toString());
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
    public function testFromStringReturnsUrlWithTrimmedValue(string $value): void
    {
        $url = Url::fromString($value);

        self::assertSame(\trim($value), $url->toString());
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
            'string-https' => 'https://github.com/ergebnis/php-cs-fixer-config',
            'string-http' => 'http://github.com/ergebnis/php-cs-fixer-config',
        ];
    }
}

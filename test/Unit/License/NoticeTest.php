<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019-2020 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config\Test\Unit\License;

use Ergebnis\PhpCsFixer\Config\License\Notice;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @covers \Ergebnis\PhpCsFixer\Config\License\Notice
 */
final class NoticeTest extends Framework\TestCase
{
    use Helper;

    /**
     * @dataProvider provideValidValue
     *
     * @param string $value
     */
    public function testFromStringReturnsNotice(string $value): void
    {
        $notice = Notice::fromString($value);

        self::assertSame($value, $notice->toString());
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
    public function testFromStringReturnsNoticeWithTrimmedValue(string $value): void
    {
        $notice = Notice::fromString($value);

        self::assertSame(\trim($value), $notice->toString());
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
        $notice = Notice::fromString(self::faker()->realText());

        self::assertFalse($notice->isEmpty());
    }

    /**
     * @dataProvider provideBlankOrEmptyString
     *
     * @param string $value
     */
    public function testIsEmptyReturnsTrueWhenTrimmedValueIsEmpty(string $value): void
    {
        $notice = Notice::fromString($value);

        self::assertTrue($notice->isEmpty());
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

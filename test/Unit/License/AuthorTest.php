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

namespace Ergebnis\PhpCsFixer\Config\Test\Unit\License;

use Ergebnis\PhpCsFixer\Config\License\Author;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @covers \Ergebnis\PhpCsFixer\Config\License\Author
 */
final class AuthorTest extends Framework\TestCase
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

        Author::fromString($value);
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
    public function testFromStringReturnsAuthor(string $value): void
    {
        $author = Author::fromString($value);

        self::assertSame($value, $author->toString());
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
    public function testFromStringReturnsAuthorWithTrimmedValue(string $value): void
    {
        $author = Author::fromString($value);

        self::assertSame(\trim($value), $author->toString());
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

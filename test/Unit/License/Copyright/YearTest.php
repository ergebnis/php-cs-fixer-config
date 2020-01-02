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

namespace Ergebnis\PhpCsFixer\Config\Test\Unit\License\Copyright;

use Ergebnis\PhpCsFixer\Config\License\Copyright\Year;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @covers \Ergebnis\PhpCsFixer\Config\License\Copyright\Year
 */
final class YearTest extends Framework\TestCase
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
            'Value "%s" does not appear to be a valid year.',
            $value
        ));

        Year::fromString($value);
    }

    public function provideInvalidValue(): \Generator
    {
        $faker = self::faker();

        $values = [
            'string-arbitrary' => $faker->sentence,
            'string-blank' => '  ',
            'string-containing-year' => \sprintf(
                '%s %s %s',
                $faker->word,
                \date('Y'),
                $faker->word
            ),
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
    public function testFromStringReturnsYear(string $value): void
    {
        $year = Year::fromString($value);

        self::assertSame($value, $year->toString());
    }

    public function provideValidValue(): \Generator
    {
        $values = [
            'string-end' => '0000',
            'string-start' => '9999',
            'string-today' => \date('Y'),
        ];

        foreach ($values as $key => $value) {
            yield $key => [
                $value,
            ];
        }
    }

    public function testCurrentReturnsYearWithUtcValue(): void
    {
        $value = new \DateTimeImmutable(
            'now',
            new \DateTimeZone('UTC')
        );

        $year = Year::current();

        self::assertSame($value->format('Y'), $year->toString());
    }

    public function testEqualsReturnsFalseWhenValueIsDifferent(): void
    {
        $one = Year::fromString('2020');
        $two = Year::fromString('2021');

        self::assertFalse($one->equals($two));
    }

    public function testEqualsReturnsTrueWhenValueIsSame(): void
    {
        $value = '2020';

        $one = Year::fromString($value);
        $two = Year::fromString($value);

        self::assertTrue($one->equals($two));
    }

    public function testGreaterThanReturnsFalseWhenValueIsEqual(): void
    {
        $value = '2020';

        $one = Year::fromString($value);
        $two = Year::fromString($value);

        self::assertFalse($one->greaterThan($two));
    }

    public function testGreaterThanReturnsFalseWhenValueIsLess(): void
    {
        $one = Year::fromString('2019');
        $two = Year::fromString('2020');

        self::assertFalse($one->greaterThan($two));
    }

    public function testGreaterThanReturnsTrueWhenValueIsGreater(): void
    {
        $one = Year::fromString('2020');
        $two = Year::fromString('2019');

        self::assertTrue($one->greaterThan($two));
    }
}

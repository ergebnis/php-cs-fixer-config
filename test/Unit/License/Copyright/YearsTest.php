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
use Ergebnis\PhpCsFixer\Config\License\Copyright\Years;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @covers \Ergebnis\PhpCsFixer\Config\License\Copyright\Years
 *
 * @uses \Ergebnis\PhpCsFixer\Config\License\Copyright\Holder
 * @uses \Ergebnis\PhpCsFixer\Config\License\Copyright\Year
 * @uses \Ergebnis\PhpCsFixer\Config\License\Url
 */
final class YearsTest extends Framework\TestCase
{
    use Helper;

    public function testFromRangeRequiresStartYearToBeEqualOrLessThanEndYear(): void
    {
        $start = Year::fromString('2020');
        $end = Year::fromString('2019');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(\sprintf(
            'Start year "%s" needs to be equal to or less than end year "%s".',
            $start->toString(),
            $end->toString()
        ));

        Years::fromRange(
            $start,
            $end
        );
    }

    public function testFromRangeReturnsYearsWhenStartYearEqualsEndYear(): void
    {
        $start = Year::fromString('2020');
        $end = Year::fromString('2020');

        $years = Years::fromRange(
            $start,
            $end
        );

        self::assertSame($start->toString(), $years->toString());
    }

    public function testFromRangeReturnsYearsWhenStartYearIsLessThanEndYear(): void
    {
        $start = Year::fromString('2019');
        $end = Year::fromString('2020');

        $years = Years::fromRange(
            $start,
            $end
        );

        $expected = \sprintf(
            '%s-%s',
            $start->toString(),
            $end->toString()
        );

        self::assertSame($expected, $years->toString());
    }

    public function testFromYearReturnsYears(): void
    {
        $year = Year::fromString('2019');

        $years = Years::fromYear($year);

        self::assertSame($year->toString(), $years->toString());
    }
}

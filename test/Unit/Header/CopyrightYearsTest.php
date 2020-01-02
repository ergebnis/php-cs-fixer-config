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

use Ergebnis\PhpCsFixer\Config\Header\CopyrightYears;
use Ergebnis\PhpCsFixer\Config\Header\Year;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @covers \Ergebnis\PhpCsFixer\Config\Header\CopyrightYears
 *
 * @uses \Ergebnis\PhpCsFixer\Config\Header\Author
 * @uses \Ergebnis\PhpCsFixer\Config\Header\Url
 * @uses \Ergebnis\PhpCsFixer\Config\Header\Year
 */
final class CopyrightYearsTest extends Framework\TestCase
{
    use Helper;

    public function testFromRangeRequiresStartYearToBeEqualOrLessThanEndYear(): void
    {
        $startYear = Year::fromString('2020');
        $endYear = Year::fromString('2019');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(\sprintf(
            'Start year "%s" needs to be equal to or less than end year "%s".',
            $startYear->toString(),
            $endYear->toString()
        ));

        CopyrightYears::fromRange(
            $startYear,
            $endYear
        );
    }

    public function testFromRangeReturnsCopyrightYearsWhenStartYearEqualsEndYear(): void
    {
        $startYear = Year::fromString('2020');
        $endYear = Year::fromString('2020');

        $copyrightYears = CopyrightYears::fromRange(
            $startYear,
            $endYear
        );

        self::assertSame($startYear->toString(), $copyrightYears->toString());
    }

    public function testFromRangeReturnsCopyrightYearsWhenStartYearIsLessThanEndYear(): void
    {
        $startYear = Year::fromString('2019');
        $endYear = Year::fromString('2020');

        $copyrightYears = CopyrightYears::fromRange(
            $startYear,
            $endYear
        );

        $expected = \sprintf(
            '%s-%s',
            $startYear->toString(),
            $endYear->toString()
        );

        self::assertSame($expected, $copyrightYears->toString());
    }

    public function testFromYearReturnsCopyrightYears(): void
    {
        $year = Year::fromString('2019');

        $copyrightYears = CopyrightYears::fromYear($year);

        self::assertSame($year->toString(), $copyrightYears->toString());
    }
}

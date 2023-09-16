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
use PHPUnit\Framework;

#[Framework\Attributes\CoversClass(PhpVersion\Major::class)]
final class MajorTest extends Framework\TestCase
{
    #[Framework\Attributes\DataProviderExternal(DataProvider\IntProvider::class, 'lessThanZero')]
    public function testFromIntRejectsInvalidValue(int $value): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(\sprintf(
            'Value needs to greater than or equal to 0, but %d is not.',
            $value,
        ));

        PhpVersion\Major::fromInt($value);
    }

    #[Framework\Attributes\DataProviderExternal(DataProvider\IntProvider::class, 'zero')]
    #[Framework\Attributes\DataProviderExternal(DataProvider\IntProvider::class, 'greaterThanZero')]
    public function testFromIntReturnsMajor(int $value): void
    {
        $major = PhpVersion\Major::fromInt($value);

        self::assertSame($value, $major->toInt());
    }
}

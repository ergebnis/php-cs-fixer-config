<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019-2026 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config\Test\Unit;

use Ergebnis\DataProvider;
use Ergebnis\PhpCsFixer;
use PHPUnit\Framework;

/**
 * @covers \Ergebnis\PhpCsFixer\Config\Name
 *
 * @uses \Ergebnis\PhpCsFixer\Config\PhpVersion
 * @uses \Ergebnis\PhpCsFixer\Config\PhpVersion\Major
 * @uses \Ergebnis\PhpCsFixer\Config\PhpVersion\Minor
 * @uses \Ergebnis\PhpCsFixer\Config\PhpVersion\Patch
 *
 * @no-named-arguments
 */
final class NameTest extends Framework\TestCase
{
    use PhpCsFixer\Config\Test\Util\Helper;

    /**
     * @dataProvider \Ergebnis\DataProvider\StringProvider::blank
     * @dataProvider \Ergebnis\DataProvider\StringProvider::empty
     */
    public function testFromStringRejectsBlankOrEmptyString(string $value): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Value can not be blank or empty.');

        PhpCsFixer\Config\Name::fromString($value);
    }

    public function testFromStringReturnsName(): void
    {
        $value = self::faker()->word();

        $name = PhpCsFixer\Config\Name::fromString($value);

        self::assertSame($value, $name->toString());
    }
}

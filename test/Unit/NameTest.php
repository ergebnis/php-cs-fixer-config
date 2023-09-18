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

use Ergebnis\DataProvider;
use Ergebnis\PhpCsFixer\Config\Name;
use Ergebnis\PhpCsFixer\Config\PhpVersion;
use Ergebnis\PhpCsFixer\Config\Test;
use PHPUnit\Framework;

#[Framework\Attributes\CoversClass(Name::class)]
#[Framework\Attributes\UsesClass(PhpVersion::class)]
#[Framework\Attributes\UsesClass(PhpVersion\Major::class)]
#[Framework\Attributes\UsesClass(PhpVersion\Minor::class)]
#[Framework\Attributes\UsesClass(PhpVersion\Patch::class)]
final class NameTest extends Framework\TestCase
{
    use Test\Util\Helper;

    #[Framework\Attributes\DataProviderExternal(DataProvider\StringProvider::class, 'blank')]
    #[Framework\Attributes\DataProviderExternal(DataProvider\StringProvider::class, 'empty')]
    public function testFromStringRejectsBlankOrEmptyString(string $value): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Value can not be blank or empty.');

        Name::fromString($value);
    }

    public function testFromStringReturnsName(): void
    {
        $value = self::faker()->word();

        $name = Name::fromString($value);

        self::assertSame($value, $name->toString());
    }
}

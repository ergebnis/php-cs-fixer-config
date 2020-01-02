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

use Ergebnis\PhpCsFixer\Config\License\Copyright\Holder;
use Ergebnis\PhpCsFixer\Config\License\Copyright\Year;
use Ergebnis\PhpCsFixer\Config\License\Copyright\Years;
use Ergebnis\PhpCsFixer\Config\License\Header;
use Ergebnis\PhpCsFixer\Config\License\Notice;
use Ergebnis\PhpCsFixer\Config\License\Url;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @covers \Ergebnis\PhpCsFixer\Config\License\Header
 *
 * @uses \Ergebnis\PhpCsFixer\Config\License\Copyright\Holder
 * @uses \Ergebnis\PhpCsFixer\Config\License\Copyright\Year
 * @uses \Ergebnis\PhpCsFixer\Config\License\Copyright\Years
 * @uses \Ergebnis\PhpCsFixer\Config\License\Notice
 * @uses \Ergebnis\PhpCsFixer\Config\License\Url
 */
final class HeaderTest extends Framework\TestCase
{
    use Helper;

    public function testCreateReturnsHeaderWhenLicenseIsEmpty(): void
    {
        $faker = self::faker();

        $years = Years::fromRange(
            Year::fromString('2019'),
            Year::fromString(\date('2020'))
        );

        $holder = Holder::fromString($faker->name);

        $url = Url::fromString($faker->url);

        $header = Header::create(
            $years,
            $holder,
            Notice::fromString(''),
            $url
        );

        $expected = <<<EOF
Copyright (c) {$years->toString()} {$holder->toString()}

@see {$url->toString()}
EOF;

        self::assertSame($expected, $header->toString());
    }

    public function testCreateReturnsHeaderWhenLicenseIsNotEmpty(): void
    {
        $faker = self::faker();

        $years = Years::fromRange(
            Year::fromString('2019'),
            Year::fromString(\date('2020'))
        );

        $holder = Holder::fromString($faker->name);

        $notice = Notice::fromString(
            <<<'EOF'
For the full copyright and license information, please view
the LICENSE file that was distributed with this source code.
EOF
        );

        $url = Url::fromString($faker->url);

        $header = Header::create(
            $years,
            $holder,
            $notice,
            $url
        );

        $expected = <<<EOF
Copyright (c) {$years->toString()} {$holder->toString()}

{$notice->toString()}

@see {$url->toString()}
EOF;

        self::assertSame($expected, $header->toString());
    }
}

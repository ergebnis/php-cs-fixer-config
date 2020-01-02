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
use Ergebnis\PhpCsFixer\Config\License\CopyrightYears;
use Ergebnis\PhpCsFixer\Config\License\Header;
use Ergebnis\PhpCsFixer\Config\License\Notice;
use Ergebnis\PhpCsFixer\Config\License\Url;
use Ergebnis\PhpCsFixer\Config\License\Year;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @covers \Ergebnis\PhpCsFixer\Config\License\Header
 *
 * @uses \Ergebnis\PhpCsFixer\Config\License\Author
 * @uses \Ergebnis\PhpCsFixer\Config\License\CopyrightYears
 * @uses \Ergebnis\PhpCsFixer\Config\License\Notice
 * @uses \Ergebnis\PhpCsFixer\Config\License\Url
 * @uses \Ergebnis\PhpCsFixer\Config\License\Year
 */
final class HeaderTest extends Framework\TestCase
{
    use Helper;

    public function testCreateReturnsHeaderWhenLicenseIsEmpty(): void
    {
        $faker = self::faker();

        $copyrightYears = CopyrightYears::fromRange(
            Year::fromString('2019'),
            Year::fromString(\date('2020'))
        );

        $author = Author::fromString($faker->name);

        $url = Url::fromString($faker->url);

        $header = Header::create(
            $copyrightYears,
            $author,
            Notice::fromString(''),
            $url
        );

        $expected = <<<EOF
Copyright (c) {$copyrightYears->toString()} {$author->toString()}

@see {$url->toString()}
EOF;

        self::assertSame($expected, $header->toString());
    }

    public function testCreateReturnsHeaderWhenLicenseIsNotEmpty(): void
    {
        $faker = self::faker();

        $copyrightYears = CopyrightYears::fromRange(
            Year::fromString('2019'),
            Year::fromString(\date('2020'))
        );

        $author = Author::fromString($faker->name);

        $notice = Notice::fromString(
            <<<'EOF'
For the full copyright and license information, please view
the LICENSE file that was distributed with this source code.
EOF
        );

        $url = Url::fromString($faker->url);

        $header = Header::create(
            $copyrightYears,
            $author,
            $notice,
            $url
        );

        $expected = <<<EOF
Copyright (c) {$copyrightYears->toString()} {$author->toString()}

{$notice->toString()}

@see {$url->toString()}
EOF;

        self::assertSame($expected, $header->toString());
    }
}

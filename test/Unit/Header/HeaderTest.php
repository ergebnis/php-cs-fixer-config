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

use Ergebnis\PhpCsFixer\Config\Header\Author;
use Ergebnis\PhpCsFixer\Config\Header\CopyrightYears;
use Ergebnis\PhpCsFixer\Config\Header\Header;
use Ergebnis\PhpCsFixer\Config\Header\License;
use Ergebnis\PhpCsFixer\Config\Header\Url;
use Ergebnis\PhpCsFixer\Config\Header\Year;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @covers \Ergebnis\PhpCsFixer\Config\Header\Header
 *
 * @uses \Ergebnis\PhpCsFixer\Config\Header\Author
 * @uses \Ergebnis\PhpCsFixer\Config\Header\CopyrightYears
 * @uses \Ergebnis\PhpCsFixer\Config\Header\License
 * @uses \Ergebnis\PhpCsFixer\Config\Header\Url
 * @uses \Ergebnis\PhpCsFixer\Config\Header\Year
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
            License::fromString(''),
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

        $license = License::fromString(
            <<<'EOF'
For the full copyright and license information, please view
the LICENSE file that was distributed with this source code.
EOF
        );

        $url = Url::fromString($faker->url);

        $header = Header::create(
            $copyrightYears,
            $author,
            $license,
            $url
        );

        $expected = <<<EOF
Copyright (c) {$copyrightYears->toString()} {$author->toString()}

{$license->toString()}

@see {$url->toString()}
EOF;

        self::assertSame($expected, $header->toString());
    }
}

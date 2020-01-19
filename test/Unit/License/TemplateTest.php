<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019-2020 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config\Test\Unit\License;

use Ergebnis\PhpCsFixer\Config\License\Template;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @covers \Ergebnis\PhpCsFixer\Config\License\Template
 */
final class TemplateTest extends Framework\TestCase
{
    use Helper;

    public function testCreateReturnsTemplate(): void
    {
        $faker = self::faker();

        $when = $faker->dateTime->format('Y');
        $who = $faker->name;

        $template = Template::fromString(
            <<<'EOF'
Ah!

This was done in <when> by <who>.

Who would have thought?

EOF
        );

        $expected = <<<EOF
Ah!

This was done in {$when} by {$who}.

Who would have thought?

EOF;

        self::assertSame($expected, $template->toString([
            '<when>' => $when,
            '<who>' => $who,
        ]));
    }
}

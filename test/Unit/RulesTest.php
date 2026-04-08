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

use Ergebnis\PhpCsFixer;
use PHPUnit\Framework;

/**
 * @covers \Ergebnis\PhpCsFixer\Config\Rules
 *
 * @no-named-arguments
 */
final class RulesTest extends Framework\TestCase
{
    use PhpCsFixer\Config\Test\Util\Helper;

    public function testEmptyReturnsRules(): void
    {
        $rules = PhpCsFixer\Config\Rules::empty();

        self::assertSame([], $rules->toArray());
    }

    public function testFromArrayReturnsRules(): void
    {
        $value = [
            'bar' => [
                'baz' => [
                    'qux',
                    'quz',
                ],
            ],
            'foo' => true,
        ];

        $rules = PhpCsFixer\Config\Rules::fromArray($value);

        self::assertSame($value, $rules->toArray());
    }

    public function testMergeReturnsRulesMergedWithRules(): void
    {
        $one = PhpCsFixer\Config\Rules::fromArray([
            'bar' => [
                'baz' => [
                    'qux',
                    'quz',
                ],
            ],
            'foo' => true,
        ]);

        $two = PhpCsFixer\Config\Rules::fromArray([
            'bar' => [
                'quux' => [],
            ],
            'baz' => true,
            'foo' => false,
        ]);

        $mutated = $one->merge($two);

        self::assertNotSame($one, $mutated);
        self::assertNotSame($two, $mutated);

        $expected = PhpCsFixer\Config\Rules::fromArray([
            'bar' => [
                'quux' => [],
            ],
            'baz' => true,
            'foo' => false,
        ]);

        self::assertEquals($expected, $mutated);
    }
}

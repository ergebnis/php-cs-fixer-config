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

use Ergebnis\PhpCsFixer\Config\Rules;
use Ergebnis\PhpCsFixer\Config\Test;
use PHPUnit\Framework;

#[Framework\Attributes\CoversClass(Rules::class)]
final class RulesTest extends Framework\TestCase
{
    use Test\Util\Helper;

    public function testEmptyReturnsRules(): void
    {
        $rules = Rules::empty();

        self::assertSame([], $rules->toArray());
    }

    public function testFromArrayReturnsRules(): void
    {
        $value = [
            'foo' => true,
            'bar' => [
                'baz' => [
                    'qux',
                    'quz',
                ],
            ],
        ];

        $rules = Rules::fromArray($value);

        self::assertSame($value, $rules->toArray());
    }

    public function testMergeReturnsRulesMergedWithRules(): void
    {
        $one = Rules::fromArray([
            'foo' => true,
            'bar' => [
                'baz' => [
                    'qux',
                    'quz',
                ],
            ],
        ]);

        $two = Rules::fromArray([
            'foo' => false,
            'bar' => [
                'quux' => [],
            ],
            'baz' => true,
        ]);

        $merged = $one->merge($two);

        $expected = Rules::fromArray([
            'foo' => false,
            'bar' => [
                'quux' => [],
            ],
            'baz' => true,
        ]);

        self::assertEquals($expected, $merged);
    }
}

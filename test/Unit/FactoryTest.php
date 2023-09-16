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

namespace Ergebnis\PhpCsFixer\Config\Test\Unit;

use Ergebnis\PhpCsFixer\Config\Factory;
use Ergebnis\PhpCsFixer\Config\Name;
use Ergebnis\PhpCsFixer\Config\PhpVersion;
use Ergebnis\PhpCsFixer\Config\Test;
use PHPUnit\Framework;

#[Framework\Attributes\CoversClass(Factory::class)]
#[Framework\Attributes\UsesClass(Name::class)]
#[Framework\Attributes\UsesClass(PhpVersion::class)]
#[Framework\Attributes\UsesClass(PhpVersion\Major::class)]
#[Framework\Attributes\UsesClass(PhpVersion\Minor::class)]
#[Framework\Attributes\UsesClass(PhpVersion\Patch::class)]
final class FactoryTest extends Framework\TestCase
{
    use Test\Util\Helper;

    public function testFromRuleSetThrowsRuntimeExceptionWhenCurrentPhpVersionIsLessThanTargetPhpVersion(): void
    {
        $targetPhpVersion = PhpVersion::create(
            PhpVersion\Major::fromInt(\PHP_MAJOR_VERSION),
            PhpVersion\Minor::fromInt(\PHP_MINOR_VERSION),
            PhpVersion\Patch::fromInt(\PHP_RELEASE_VERSION + 1),
        );

        $ruleSet = new Test\Double\Config\RuleSet\DummyRuleSet(
            Name::fromString(self::faker()->word()),
            [],
            $targetPhpVersion,
        );

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(\sprintf(
            'Current PHP version "%s" is less than targeted PHP version "%s".',
            PhpVersion::current()->toString(),
            $targetPhpVersion->toString(),
        ));

        Factory::fromRuleSet($ruleSet);
    }

    #[Framework\Attributes\DataProvider('provideTargetPhpVersionLessThanOrEqualToCurrentPhpVersion')]
    public function testFromRuleSetCreatesConfigWhenCurrentPhpVersionIsEqualToOrGreaterThanTargetPhpVersion(PhpVersion $targetPhpVersion): void
    {
        $rules = [
            'foo' => true,
            'bar' => [
                'baz' => true,
            ],
        ];

        $ruleSet = new Test\Double\Config\RuleSet\DummyRuleSet(
            Name::fromString(self::faker()->word()),
            $rules,
            $targetPhpVersion,
        );

        $config = Factory::fromRuleSet($ruleSet);

        self::assertTrue($config->getUsingCache());
        self::assertTrue($config->getRiskyAllowed());
        self::assertSame($rules, $config->getRules());
    }

    /**
     * @return \Generator<int, array{0: PhpVersion}>
     */
    public static function provideTargetPhpVersionLessThanOrEqualToCurrentPhpVersion(): \Generator
    {
        $values = [
            PhpVersion::fromInt(\PHP_VERSION_ID - 1),
            PhpVersion::fromInt(\PHP_VERSION_ID),
        ];

        foreach ($values as $value) {
            yield [
                $value,
            ];
        }
    }

    public function testFromRuleSetCreatesConfigWithOverrideRules(): void
    {
        $rules = [
            'foo' => true,
            'bar' => [
                'baz' => true,
            ],
        ];

        $ruleSet = new Test\Double\Config\RuleSet\DummyRuleSet(
            Name::fromString(self::faker()->word()),
            $rules,
            PhpVersion::create(
                PhpVersion\Major::fromInt(\PHP_MAJOR_VERSION),
                PhpVersion\Minor::fromInt(\PHP_MINOR_VERSION),
                PhpVersion\Patch::fromInt(\PHP_RELEASE_VERSION),
            ),
        );

        $overrideRules = [
            'foo' => false,
        ];

        $config = Factory::fromRuleSet(
            $ruleSet,
            $overrideRules,
        );

        self::assertTrue($config->getUsingCache());
        self::assertTrue($config->getRiskyAllowed());
        self::assertEquals(\array_merge($rules, $overrideRules), $config->getRules());
    }
}

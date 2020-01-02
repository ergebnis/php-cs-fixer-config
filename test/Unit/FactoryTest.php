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

namespace Ergebnis\PhpCsFixer\Config\Test\Unit;

use Ergebnis\PhpCsFixer\Config;
use PHPUnit\Framework;

/**
 * @internal
 *
 * @covers \Ergebnis\PhpCsFixer\Config\Factory
 */
final class FactoryTest extends Framework\TestCase
{
    public function testIsFinal(): void
    {
        $reflection = new \ReflectionClass(Config\Factory::class);

        self::assertTrue($reflection->isFinal());
    }

    public function testFromRuleSetThrowsRuntimeExceptionIfCurrentPhpVersionIsLessThanTargetPhpVersion(): void
    {
        $targetPhpVersion = \PHP_VERSION_ID + 1;

        $ruleSet = $this->prophesize(Config\RuleSet::class);

        $ruleSet
            ->name()
            ->shouldNotBeCalled();

        $ruleSet
            ->rules()
            ->shouldNotBeCalled();

        $ruleSet
            ->targetPhpVersion()
            ->shouldBeCalled()
            ->willReturn($targetPhpVersion);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(\sprintf(
            'Current PHP version "%s" is less than targeted PHP version "%s".',
            \PHP_VERSION_ID,
            $targetPhpVersion
        ));

        Config\Factory::fromRuleSet($ruleSet->reveal());
    }

    /**
     * @dataProvider providerTargetPhpVersion
     *
     * @param int $targetPhpVersion
     */
    public function testFromRuleSetCreatesConfig(int $targetPhpVersion): void
    {
        $name = 'foobarbaz';

        $rules = [
            'foo' => true,
            'bar' => [
                'baz',
            ],
        ];

        $ruleSet = $this->prophesize(Config\RuleSet::class);

        $ruleSet
            ->name()
            ->shouldBeCalled()
            ->willReturn($name);

        $ruleSet
            ->rules()
            ->shouldBeCalled()
            ->willReturn($rules);

        $ruleSet
            ->targetPhpVersion()
            ->shouldBeCalled()
            ->willReturn($targetPhpVersion);

        $config = Config\Factory::fromRuleSet($ruleSet->reveal());

        self::assertTrue($config->getUsingCache());
        self::assertTrue($config->getRiskyAllowed());
        self::assertSame($rules, $config->getRules());
    }

    public function providerTargetPhpVersion(): \Generator
    {
        $values = [
            \PHP_VERSION_ID - 1,
            \PHP_VERSION_ID,
        ];

        foreach ($values as $value) {
            yield [
                $value,
            ];
        }
    }

    public function testFromRuleSetCreatesConfigWithOverrideRules(): void
    {
        $name = 'foobarbaz';

        $rules = [
            'foo' => true,
            'bar' => [
                'baz',
            ],
        ];

        $overrideRules = [
            'foo' => false,
        ];

        $ruleSet = $this->prophesize(Config\RuleSet::class);

        $ruleSet
            ->name()
            ->shouldBeCalled()
            ->willReturn($name);

        $ruleSet
            ->rules()
            ->shouldBeCalled()
            ->willReturn($rules);

        $ruleSet
            ->targetPhpVersion()
            ->shouldBeCalled()
            ->willReturn(\PHP_VERSION_ID);

        $config = Config\Factory::fromRuleSet(
            $ruleSet->reveal(),
            $overrideRules
        );

        self::assertTrue($config->getUsingCache());
        self::assertTrue($config->getRiskyAllowed());
        self::assertSame(\array_merge($rules, $overrideRules), $config->getRules());
    }
}

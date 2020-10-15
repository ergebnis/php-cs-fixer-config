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
    public function testFromRuleSetThrowsRuntimeExceptionIfCurrentPhpVersionIsLessThanTargetPhpVersion(): void
    {
        $targetPhpVersion = \PHP_VERSION_ID + 1;

        $ruleSet = new class($targetPhpVersion) implements Config\RuleSet {
            /**
             * @var int
             */
            private $phpVersion;

            public function __construct(int $phpVersion)
            {
                $this->phpVersion = $phpVersion;
            }

            public function name(): string
            {
                return \spl_object_hash($this);
            }

            public function rules(): array
            {
                return [];
            }

            public function targetPhpVersion(): int
            {
                return $this->phpVersion;
            }
        };

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(\sprintf(
            'Current PHP version "%s" is less than targeted PHP version "%s".',
            \PHP_VERSION_ID,
            $targetPhpVersion
        ));

        Config\Factory::fromRuleSet($ruleSet);
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

        $ruleSet = new class($name, $rules, $targetPhpVersion) implements Config\RuleSet {
            /**
             * @var string
             */
            private $name;

            /**
             * @var array
             */
            private $rules;

            /**
             * @var int
             */
            private $phpVersion;

            public function __construct(string $name, array $rules, int $phpVersion)
            {
                $this->name = $name;
                $this->rules = $rules;
                $this->phpVersion = $phpVersion;
            }

            public function name(): string
            {
                return $this->name;
            }

            public function rules(): array
            {
                return $this->rules;
            }

            public function targetPhpVersion(): int
            {
                return $this->phpVersion;
            }
        };

        $config = Config\Factory::fromRuleSet($ruleSet);

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

        $targetPhpVersion = \PHP_VERSION_ID;

        $ruleSet = new class($name, $rules, $targetPhpVersion) implements Config\RuleSet {
            /**
             * @var string
             */
            private $name;

            /**
             * @var array
             */
            private $rules;

            /**
             * @var int
             */
            private $phpVersion;

            public function __construct(string $name, array $rules, int $phpVersion)
            {
                $this->name = $name;
                $this->rules = $rules;
                $this->phpVersion = $phpVersion;
            }

            public function name(): string
            {
                return $this->name;
            }

            public function rules(): array
            {
                return $this->rules;
            }

            public function targetPhpVersion(): int
            {
                return $this->phpVersion;
            }
        };

        $overrideRules = [
            'foo' => false,
        ];

        $config = Config\Factory::fromRuleSet(
            $ruleSet,
            $overrideRules
        );

        self::assertTrue($config->getUsingCache());
        self::assertTrue($config->getRiskyAllowed());
        self::assertSame(\array_merge($rules, $overrideRules), $config->getRules());
    }
}

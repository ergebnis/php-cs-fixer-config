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

namespace Ergebnis\PhpCsFixer\Config\Test\Unit\RuleSet;

use Ergebnis\PhpCsFixer\Config;
use PhpCsFixer\Fixer;
use PhpCsFixer\FixerFactory;
use PhpCsFixer\RuleSet;
use PHPUnit\Framework;

/**
 * @internal
 */
abstract class AbstractRuleSetTestCase extends Framework\TestCase
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $rules;

    /**
     * @var int
     */
    protected $targetPhpVersion;

    final public function testDefaults(): void
    {
        $ruleSet = self::createRuleSet();

        self::assertSame($this->name, $ruleSet->name());
        self::assertEquals($this->rules, $ruleSet->rules());
        self::assertEquals($this->targetPhpVersion, $ruleSet->targetPhpVersion());
    }

    final public function testAllConfiguredRulesAreBuiltIn(): void
    {
        $fixersNotBuiltIn = \array_diff(
            $this->configuredFixers(),
            $this->builtInFixers()
        );

        \sort($fixersNotBuiltIn);

        self::assertEmpty($fixersNotBuiltIn, \sprintf(
            'Failed to assert that fixers for the rules "%s" are built in',
            \implode('", "', $fixersNotBuiltIn)
        ));
    }

    final public function testAllBuiltInRulesAreConfigured(): void
    {
        $fixersWithoutConfiguration = \array_diff(
            $this->builtInFixers(),
            $this->configuredFixers()
        );

        \sort($fixersWithoutConfiguration);

        self::assertEmpty($fixersWithoutConfiguration, \sprintf(
            'Failed to assert that built-in fixers for the rules "%s" are configured',
            \implode('", "', $fixersWithoutConfiguration)
        ));
    }

    final public function testHeaderCommentFixerIsDisabledByDefault(): void
    {
        $rules = self::createRuleSet()->rules();

        self::assertArrayHasKey('header_comment', $rules);
        self::assertFalse($rules['header_comment']);
    }

    /**
     * @dataProvider providerValidHeader
     *
     * @param string $header
     */
    final public function testHeaderCommentFixerIsEnabledIfHeaderIsProvided($header): void
    {
        $rules = self::createRuleSet($header)->rules();

        self::assertArrayHasKey('header_comment', $rules);

        $expected = [
            'comment_type' => 'PHPDoc',
            'header' => \trim($header),
            'location' => 'after_declare_strict',
            'separate' => 'both',
        ];

        self::assertSame($expected, $rules['header_comment']);
    }

    final public function providerValidHeader(): \Generator
    {
        $values = [
            'string-empty' => '',
            'string-not-empty' => 'foo',
            'string-with-line-feed-only' => "\n",
            'string-with-spaces-only' => ' ',
            'string-with-tab-only' => "\t",
        ];

        foreach ($values as $key => $value) {
            yield $key => [
                $value,
            ];
        }
    }

    /**
     * @dataProvider providerRuleNames
     *
     * @param string[] $ruleNames
     */
    final public function testRulesAreSortedByName(string $source, array $ruleNames): void
    {
        $sorted = $ruleNames;

        \sort($sorted);

        self::assertEquals($sorted, $ruleNames, \sprintf(
            'Failed to assert that the rules are sorted by name in %s',
            $source
        ));
    }

    final public function providerRuleNames(): \Generator
    {
        $values = [
            'rule set' => self::createRuleSet()->rules(),
            'test' => $this->rules,
        ];

        foreach ($values as $source => $rules) {
            yield [
                $source,
                \array_keys($rules),
            ];
        }
    }

    /**
     * @throws \RuntimeException
     */
    final protected static function className(): string
    {
        $className = \preg_replace(
            '/Test$/',
            '',
            \str_replace(
                '\Test\Unit',
                '',
                static::class
            )
        );

        if (!\is_string($className)) {
            throw new \RuntimeException(\sprintf(
                'Failed resolving class name from test class name "%s".',
                static::class
            ));
        }

        return $className;
    }

    /**
     * @param string $header
     *
     * @throws \RuntimeException
     */
    final protected static function createRuleSet($header = null): Config\RuleSet
    {
        /** @var class-string $className */
        $className = self::className();

        $reflection = new \ReflectionClass($className);

        $ruleSet = $reflection->newInstance($header);

        if (!$ruleSet instanceof Config\RuleSet) {
            throw new \RuntimeException(\sprintf(
                'Class %s" does not implement interface "%s".',
                $className,
                Config\RuleSet::class
            ));
        }

        return $ruleSet;
    }

    /**
     * @return string[]
     */
    private function builtInFixers(): array
    {
        static $builtInFixers;

        if (null === $builtInFixers) {
            $fixerFactory = FixerFactory::create();
            $fixerFactory->registerBuiltInFixers();

            $builtInFixers = \array_map(static function (Fixer\FixerInterface $fixer): string {
                return $fixer->getName();
            }, $fixerFactory->getFixers());
        }

        return $builtInFixers;
    }

    private function configuredFixers(): array
    {
        /**
         * RuleSet::create() removes disabled fixers, to let's just enable them to make sure they are not removed.
         *
         * @see https://github.com/FriendsOfPHP/PHP-CS-Fixer/pull/2361
         */
        $rules = \array_map(static function ($ruleConfiguration): bool {
            return true;
        }, self::createRuleSet()->rules());

        return \array_keys(RuleSet::create($rules)->getRules());
    }
}

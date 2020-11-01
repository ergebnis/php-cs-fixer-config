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

    final public function testAllConfiguredFixersAreBuiltIn(): void
    {
        $namesOfFixersNotBuiltIn = \array_diff(
            self::configuredFixerNames(),
            self::builtInFixerNames()
        );

        \sort($namesOfFixersNotBuiltIn);

        self::assertEmpty($namesOfFixersNotBuiltIn, \sprintf(
            "Failed asserting that fixers with the names\n\n%s\n\nare built in.",
            ' - ' . \implode("\n - ", $namesOfFixersNotBuiltIn)
        ));
    }

    final public function testAllBuiltInFixersAreConfigured(): void
    {
        $namesOfFixersWithoutConfiguration = \array_diff(
            self::builtInFixerNames(),
            self::configuredFixerNames()
        );

        \sort($namesOfFixersWithoutConfiguration);

        self::assertEmpty($namesOfFixersWithoutConfiguration, \sprintf(
            "Failed asserting that built-in fixers with the names\n\n%s\n\nare configured.",
            ' - ' . \implode("\n - ", $namesOfFixersWithoutConfiguration)
        ));
    }

    final public function testHeaderCommentFixerIsDisabledByDefault(): void
    {
        $rules = self::createRuleSet()->rules();

        self::assertArrayHasKey('header_comment', $rules);
        self::assertFalse($rules['header_comment']);
    }

    /**
     * @dataProvider provideValidHeader
     */
    final public function testHeaderCommentFixerIsEnabledIfHeaderIsProvided(string $header): void
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

    /**
     * @return \Generator<string, array{0: string}>
     */
    final public function provideValidHeader(): \Generator
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

    final public function testRulesAreSortedByNameInRuleSet(): void
    {
        $ruleNames = \array_keys(self::createRuleSet()->rules());

        $sorted = $ruleNames;

        \sort($sorted);

        self::assertEquals($sorted, $ruleNames, \sprintf(
            'Failed asserting that the rules are sorted by name in rule set "%s".',
            static::className()
        ));
    }

    final public function testRulesAreSortedByNameInRuleSetTest(): void
    {
        $ruleNames = \array_keys($this->rules);

        $sorted = $ruleNames;

        \sort($sorted);

        self::assertEquals($sorted, $ruleNames, \sprintf(
            'Failed asserting that the rules are sorted by name in rule set test "%s".',
            static::class
        ));
    }

    final public function testRulesDoNotContainRuleSets(): void
    {
        $ruleNames = \array_keys(self::createRuleSet()->rules());

        $namesOfConfiguredRuleSets = \array_filter($ruleNames, static function (string $ruleName): bool {
            return '@' === \mb_substr($ruleName, 0, 1);
        });

        self::assertEmpty($namesOfConfiguredRuleSets, \sprintf(
            "Failed asserting that rule sets \n\n%s\n\nare not configured in rule set \"%s\".",
            ' - ' . \implode("\n - ", $namesOfConfiguredRuleSets),
            static::className()
        ));
    }

    /**
     * @phpstan-return class-string
     *
     * @psalm-return class-string
     *
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

        if (!\class_exists($className)) {
            throw new \RuntimeException(\sprintf(
                'Class name "%s" resolved from test class name "%s" does not reference a class that exists.',
                $className,
                static::class
            ));
        }

        return $className;
    }

    /**
     * @throws \RuntimeException
     */
    final protected static function createRuleSet(?string $header = null): Config\RuleSet
    {
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
     * @return array<int, string>
     */
    private static function builtInFixerNames(): array
    {
        $fixerFactory = FixerFactory::create();

        $fixerFactory->registerBuiltInFixers();

        /** @var array<int, string> $builtInFixerNames */
        $builtInFixerNames = \array_values(\array_map(static function (Fixer\FixerInterface $fixer): string {
            return $fixer->getName();
        }, $fixerFactory->getFixers()));

        return $builtInFixerNames;
    }

    /**
     * @return array<int, string>
     */
    private static function configuredFixerNames(): array
    {
        /**
         * RuleSet::create() removes disabled fixers, to let's just enable them to make sure they are not removed.
         *
         * @see https://github.com/FriendsOfPHP/PHP-CS-Fixer/pull/2361
         */
        $rules = \array_map(static function ($ruleConfiguration): bool {
            return true;
        }, self::createRuleSet()->rules());

        /** @var array<string, Fixer\FixerInterface> $fixers */
        $fixers = RuleSet::create($rules)->getRules();

        return \array_keys($fixers);
    }
}

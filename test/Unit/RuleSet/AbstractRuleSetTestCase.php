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

    final public function testRulesDoNotConfigureRuleSets(): void
    {
        $ruleNames = \array_keys(self::createRuleSet()->rules());

        $namesOfConfiguredRuleSets = \array_filter($ruleNames, static function (string $ruleName): bool {
            return '@' === \mb_substr($ruleName, 0, 1);
        });

        self::assertEmpty($namesOfConfiguredRuleSets, \sprintf(
            "Failed asserting that rule set \"%s\" does not configure rule sets. Rule sets with names\n\n%s\n\nshould not be used.",
            static::className(),
            ' - ' . \implode("\n - ", $namesOfConfiguredRuleSets)
        ));
    }

    final public function testRulesDoNotConfigureUnknownFixers(): void
    {
        $namesOfUnknownFixers = \array_diff(
            self::namesOfConfiguredFixers(),
            self::namesOfKnownFixers()
        );

        \sort($namesOfUnknownFixers);

        self::assertEmpty($namesOfUnknownFixers, \sprintf(
            "Failed asserting that rule set \"%s\" configures only known fixers. Fixers with names\n\n%s\n\nare unknown.",
            static::className(),
            ' - ' . \implode("\n - ", $namesOfUnknownFixers)
        ));
    }

    final public function testRulesDoNotConfigureDeprecatedFixers(): void
    {
        $namesOfConfiguredDeprecatedFixers = \array_diff(
            self::namesOfConfiguredFixers(),
            self::namesOfNonDeprecatedFixers()
        );

        self::assertEmpty($namesOfConfiguredDeprecatedFixers, \sprintf(
            "Failed asserting that rule set \"%s\" does not configure deprecated fixers. Fixers with names\n\n%s\n\nare deprecated.",
            static::className(),
            ' - ' . \implode("\n - ", $namesOfConfiguredDeprecatedFixers)
        ));
    }

    final public function testRulesConfigureAllNonDeprecatedFixers(): void
    {
        $namesOfNonDeprecatedFixersWithoutConfiguration = \array_diff(
            self::namesOfNonDeprecatedFixers(),
            self::namesOfKnownFixers()
        );

        \sort($namesOfNonDeprecatedFixersWithoutConfiguration);

        self::assertEmpty($namesOfNonDeprecatedFixersWithoutConfiguration, \sprintf(
            "Failed asserting that rule set \"%s\" configures all non-deprecated fixers. Fixers with the names\n\n%s\n\nare not configured.",
            static::className(),
            ' - ' . \implode("\n - ", $namesOfNonDeprecatedFixersWithoutConfiguration)
        ));
    }

    final public function testRulesAreSortedByName(): void
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
     * @return array<string, Fixer\FixerInterface>
     */
    private static function builtInFixers(): array
    {
        $fixerFactory = FixerFactory::create();

        $fixerFactory->registerBuiltInFixers();

        $fixers = $fixerFactory->getFixers();

        /** @var array<string, Fixer\FixerInterface> $builtInFixers */
        $builtInFixers = \array_combine(
            \array_map(static function (Fixer\FixerInterface $fixer): string {
                return $fixer->getName();
            }, $fixers),
            $fixers
        );

        \ksort($builtInFixers);

        return $builtInFixers;
    }

    /**
     * @return array<int, string>
     */
    private static function namesOfConfiguredFixers(): array
    {
        /**
         * RuleSet::create() removes disabled fixers, to let's just enable them to make sure they are not removed.
         *
         * @see https://github.com/FriendsOfPHP/PHP-CS-Fixer/pull/2361
         */
        $rules = \array_map(static function ($ruleConfiguration): bool {
            return true;
        }, self::createRuleSet()->rules());

        $ruleSet = new RuleSet\RuleSet($rules);

        /** @var array<string, Fixer\FixerInterface> $fixers */
        $fixers = $ruleSet->getRules();

        \ksort($fixers);

        return \array_keys($fixers);
    }

    /**
     * @return array<int, string>
     */
    private static function namesOfKnownFixers(): array
    {
        return \array_keys(self::builtInFixers());
    }

    /**
     * @return array<int, string>
     */
    private static function namesOfNonDeprecatedFixers(): array
    {
        return \array_keys(\array_filter(self::builtInFixers(), static function (Fixer\FixerInterface $fixer): bool {
            return !$fixer instanceof Fixer\DeprecatedFixerInterface;
        }));
    }
}

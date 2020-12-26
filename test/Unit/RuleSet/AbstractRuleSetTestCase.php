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
use PhpCsFixer\FixerConfiguration;
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
        self::assertSame($this->rules, $ruleSet->rules());
        self::assertSame($this->targetPhpVersion, $ruleSet->targetPhpVersion());
    }

    final public function testRuleSetDoesNotConfigureRulesThatAreNotBuiltIn(): void
    {
        $namesOfRulesThatAreConfiguredAndNotBuiltIn = \array_diff(
            self::namesOfRulesThatAreConfigured(),
            self::namesOfRulesThatAreBuiltIn()
        );

        self::assertEmpty($namesOfRulesThatAreConfiguredAndNotBuiltIn, \sprintf(
            "Failed asserting that rule set \"%s\" configures only built-in rules. Rules with names\n\n%s\n\nare unknown.",
            static::className(),
            ' - ' . \implode("\n - ", $namesOfRulesThatAreConfiguredAndNotBuiltIn)
        ));
    }

    final public function testRuleSetDoesNotConfigureRulesThatAreDeprecated(): void
    {
        $namesOfRulesThatAreConfiguredAndDeprecated = \array_intersect(
            self::namesOfRulesThatAreBuiltInAndDeprecated(),
            self::namesOfRulesThatAreConfigured()
        );

        self::assertEmpty($namesOfRulesThatAreConfiguredAndDeprecated, \sprintf(
            "Failed asserting that rule set \"%s\" does not configure deprecated rules. Rules with names\n\n%s\n\nare deprecated.",
            static::className(),
            ' - ' . \implode("\n - ", $namesOfRulesThatAreConfiguredAndDeprecated)
        ));
    }

    final public function testRuleSetDoesNotConfigureRulesUsingDeprecatedConfigurationOptions(): void
    {
        $rules = self::createRuleSet()->rules();

        $namesOfRules = \array_keys($rules);

        $fixersThatAreBuiltIn = self::fixersThatAreBuiltIn();

        $rulesWithoutDeprecatedConfigurationOptions = \array_combine(
            $namesOfRules,
            \array_map(static function (string $nameOfRule, $ruleConfiguration) use ($fixersThatAreBuiltIn) {
                if (!\is_array($ruleConfiguration)) {
                    return $ruleConfiguration;
                }

                $fixer = $fixersThatAreBuiltIn[$nameOfRule];

                if ($fixer instanceof Fixer\DeprecatedFixerInterface) {
                    return $ruleConfiguration;
                }

                if (!$fixer instanceof Fixer\ConfigurationDefinitionFixerInterface) {
                    return $ruleConfiguration;
                }

                $configurationOptions = $fixer->getConfigurationDefinition()->getOptions();

                $deprecatedConfigurationOptions = \array_filter($configurationOptions, static function (FixerConfiguration\FixerOptionInterface $fixerOption): bool {
                    return $fixerOption instanceof FixerConfiguration\DeprecatedFixerOptionInterface;
                });

                return \array_diff_key(
                    $ruleConfiguration,
                    \array_flip(\array_map(static function (FixerConfiguration\FixerOptionInterface $fixerOption): string {
                        return $fixerOption->getName();
                    }, $deprecatedConfigurationOptions))
                );
            }, $namesOfRules, $rules)
        );

        self::assertSame($rulesWithoutDeprecatedConfigurationOptions, $rules, \sprintf(
            'Failed asserting that rule set "%s" does not configure rules using deprecated configuration options.',
            static::className()
        ));
    }

    final public function testRulesAndConfigurationOptionsAreSortedInRuleSet(): void
    {
        $rules = self::createRuleSet()->rules();

        $sorted = self::sort($rules);

        self::assertSame($sorted, $rules, \sprintf(
            'Failed asserting that rules and configuration options are sorted by name in rule set "%s".',
            static::className()
        ));
    }

    final public function testRulesAndConfigurationOptionsAreSortedInRuleSetTest(): void
    {
        $rules = $this->rules;

        $sorted = self::sort($rules);

        self::assertSame($sorted, $rules, \sprintf(
            'Failed asserting that rules and configuration options are sorted by name in rule set test "%s".',
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
    final protected static function fixersThatAreBuiltIn(): array
    {
        $fixerFactory = FixerFactory::create();

        $fixerFactory->registerBuiltInFixers();

        $fixers = $fixerFactory->getFixers();

        /** @var array<string, Fixer\FixerInterface> $fixersThatAreBuiltIn */
        $fixersThatAreBuiltIn = \array_combine(
            \array_map(static function (Fixer\FixerInterface $fixer): string {
                return $fixer->getName();
            }, $fixers),
            $fixers
        );

        \ksort($fixersThatAreBuiltIn);

        return $fixersThatAreBuiltIn;
    }

    final protected static function sort(array $data): array
    {
        $keys = \array_keys($data);

        $keysThatAreNotStrings = \array_filter($keys, static function ($key): bool {
            return !\is_string($key);
        });

        if ([] !== $keysThatAreNotStrings) {
            return $data;
        }

        \ksort($data);

        return \array_combine(
            \array_keys($data),
            \array_map(static function ($item) {
                if (!\is_array($item)) {
                    return $item;
                }

                return self::sort($item);
            }, $data)
        );
    }

    /**
     * @return array<int, string>
     */
    final protected static function namesOfRulesThatAreConfigured(): array
    {
        /**
         * RuleSet\RuleSet::resolveSet() removes disabled fixers, to let's just enable them to make sure they are not removed.
         *
         * @see RuleSet\RuleSet::resolveSet()
         */
        $rules = \array_map(static function ($ruleConfiguration): bool {
            return true;
        }, self::createRuleSet()->rules());

        $ruleSet = new RuleSet\RuleSet($rules);

        /** @var array<string, bool> $rulesThatAreConfigured */
        $rulesThatAreConfigured = $ruleSet->getRules();

        \ksort($rulesThatAreConfigured);

        return \array_keys($rulesThatAreConfigured);
    }

    /**
     * @return array<int, string>
     */
    private static function namesOfRulesThatAreBuiltIn(): array
    {
        return \array_keys(self::fixersThatAreBuiltIn());
    }

    /**
     * @return array<int, string>
     */
    private static function namesOfRulesThatAreBuiltInAndDeprecated(): array
    {
        return \array_keys(\array_filter(self::fixersThatAreBuiltIn(), static function (Fixer\FixerInterface $fixer): bool {
            return $fixer instanceof Fixer\DeprecatedFixerInterface;
        }));
    }
}

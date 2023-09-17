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

namespace Ergebnis\PhpCsFixer\Config\Test\Unit\RuleSet;

use Ergebnis\PhpCsFixer\Config\Name;
use Ergebnis\PhpCsFixer\Config\PhpVersion;
use Ergebnis\PhpCsFixer\Config\Rules;
use Ergebnis\PhpCsFixer\Config\RuleSet;
use PhpCsFixer\Fixer;
use PhpCsFixer\FixerConfiguration;
use PhpCsFixer\FixerFactory;
use PHPUnit\Framework;

abstract class AbstractRuleSetTestCase extends Framework\TestCase
{
    final public function testDefaults(): void
    {
        $ruleSet = static::createRuleSet();

        self::assertEquals($this->expectedCustomFixers(), $ruleSet->customFixers());
        self::assertEquals($this->expectedName(), $ruleSet->name());
        self::assertEquals($this->expectedRules(), $ruleSet->rules());
        self::assertEquals($this->expectedTargetPhpVersion(), $ruleSet->targetPhpVersion());
    }

    final public function testRuleSetDoesNotConfigureRulesThatAreNotRegistered(): void
    {
        $ruleSet = static::createRuleSet();

        $rules = $ruleSet->rules();

        $fixersThatAreRegistered = self::fixersThatAreRegistered();

        $rulesWithoutRulesThatAreNotRegistered = \array_filter(
            $rules->toArray(),
            static function (string $nameOfRule) use ($fixersThatAreRegistered): bool {
                if (\str_starts_with($nameOfRule, '@')) {
                    return true;
                }

                return \array_key_exists(
                    $nameOfRule,
                    $fixersThatAreRegistered,
                );
            },
            \ARRAY_FILTER_USE_KEY,
        );

        self::assertEquals($rulesWithoutRulesThatAreNotRegistered, $rules->toArray(), \sprintf(
            'Failed asserting that rule set "%s" does not configure rules that are not registered.',
            $ruleSet::class,
        ));
    }

    final public function testRuleSetDoesNotConfigureRulesThatAreDeprecated(): void
    {
        $ruleSet = static::createRuleSet();

        $rules = $ruleSet->rules();

        $fixersThatAreRegistered = self::fixersThatAreRegistered();

        $rulesWithoutRulesThatAreDeprecated = \array_filter(
            $rules->toArray(),
            static function (string $nameOfRule) use ($fixersThatAreRegistered): bool {
                if (!\array_key_exists($nameOfRule, $fixersThatAreRegistered)) {
                    return true;
                }

                $fixer = $fixersThatAreRegistered[$nameOfRule];

                return !$fixer instanceof Fixer\DeprecatedFixerInterface;
            },
            \ARRAY_FILTER_USE_KEY,
        );

        self::assertEquals($rulesWithoutRulesThatAreDeprecated, $rules->toArray(), \sprintf(
            'Failed asserting that rule set "%s" does not configure rules that are deprecated.',
            $ruleSet::class,
        ));
    }

    final public function testRuleSetDoesNotConfigureRulesUsingDeprecatedConfigurationOptions(): void
    {
        $ruleSet = static::createRuleSet();

        $rules = $ruleSet->rules();

        $namesOfRules = \array_keys($rules->toArray());

        $fixersThatAreRegistered = self::fixersThatAreRegistered();

        $rulesWithoutDeprecatedConfigurationOptions = \array_combine(
            $namesOfRules,
            \array_map(static function (string $nameOfRule, $ruleConfiguration) use ($fixersThatAreRegistered) {
                if (!\is_array($ruleConfiguration)) {
                    return $ruleConfiguration;
                }

                $fixer = $fixersThatAreRegistered[$nameOfRule];

                if ($fixer instanceof Fixer\DeprecatedFixerInterface) {
                    return $ruleConfiguration;
                }

                if (!$fixer instanceof Fixer\ConfigurableFixerInterface) {
                    return $ruleConfiguration;
                }

                $configurationOptions = $fixer->getConfigurationDefinition()->getOptions();

                $deprecatedConfigurationOptions = \array_filter($configurationOptions, static function (FixerConfiguration\FixerOptionInterface $fixerOption): bool {
                    return $fixerOption instanceof FixerConfiguration\DeprecatedFixerOptionInterface;
                });

                $ruleConfigurationWithoutDeprecatedConfigurationOptions = \array_diff_key(
                    $ruleConfiguration,
                    \array_flip(\array_map(static function (FixerConfiguration\FixerOptionInterface $fixerOption): string {
                        return $fixerOption->getName();
                    }, $deprecatedConfigurationOptions)),
                );

                if ([] === $ruleConfigurationWithoutDeprecatedConfigurationOptions) {
                    return true;
                }

                return $ruleConfigurationWithoutDeprecatedConfigurationOptions;
            }, $namesOfRules, $rules->toArray()),
        );

        self::assertEquals($rulesWithoutDeprecatedConfigurationOptions, $rules->toArray(), \sprintf(
            'Failed asserting that rule set "%s" does not configure rules using deprecated configuration options.',
            $ruleSet::class,
        ));
    }

    final public function testRulesAndConfigurationOptionsAreSortedInRuleSet(): void
    {
        $ruleSet = static::createRuleSet();

        $rules = $ruleSet->rules();

        $sorted = self::sort($rules->toArray());

        self::assertSame($sorted, $rules->toArray(), \sprintf(
            'Failed asserting that rules and configuration options are sorted by name in rule set "%s".',
            $ruleSet::class,
        ));
    }

    final public function testRulesAndConfigurationOptionsAreSortedInRuleSetTest(): void
    {
        $rules = $this->expectedRules();

        $sorted = self::sort($rules->toArray());

        self::assertSame($sorted, $rules->toArray(), \sprintf(
            'Failed asserting that rules and configuration options are sorted by name in rule set test "%s".',
            static::class,
        ));
    }

    final public function testHeaderCommentFixerIsDisabledByDefault(): void
    {
        $rules = static::createRuleSet()->rules();

        self::assertArrayHasKey('header_comment', $rules->toArray());
        self::assertFalse($rules->toArray()['header_comment']);
    }

    #[Framework\Attributes\DataProvider('provideValidHeader')]
    final public function testHeaderCommentFixerIsEnabledIfHeaderIsProvided(string $header): void
    {
        $rules = static::createRuleSet($header)->rules();

        self::assertArrayHasKey('header_comment', $rules->toArray());

        $expected = [
            'comment_type' => 'PHPDoc',
            'header' => \trim($header),
            'location' => 'after_declare_strict',
            'separate' => 'both',
        ];

        self::assertEquals($expected, $rules->toArray()['header_comment']);
    }

    /**
     * @return \Generator<string, array{0: string}>
     */
    final public static function provideValidHeader(): \Generator
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

    abstract protected function expectedCustomFixers(): iterable;

    abstract protected function expectedName(): Name;

    abstract protected function expectedRules(): Rules;

    abstract protected function expectedTargetPhpVersion(): PhpVersion;

    /**
     * @throws \RuntimeException
     */
    abstract protected static function createRuleSet(?string $header = null): RuleSet;

    /**
     * @return array<string, Fixer\FixerInterface>
     */
    final protected static function fixersThatAreRegistered(): array
    {
        $fixerFactory = new FixerFactory();

        $fixerFactory->registerBuiltInFixers();

        $fixersThatAreBuiltIn = $fixerFactory->getFixers();
        $fixersThatShouldBeRegistered = \iterator_to_array(static::createRuleSet()->customFixers());

        /** @var array<Fixer\FixerInterface> $fixers */
        $fixers = \array_merge(
            $fixersThatAreBuiltIn,
            $fixersThatShouldBeRegistered,
        );

        $fixersThatAreRegistered = \array_combine(
            \array_map(static function (Fixer\FixerInterface $fixer): string {
                return $fixer->getName();
            }, $fixers),
            $fixers,
        );

        \ksort($fixersThatAreRegistered);

        return $fixersThatAreRegistered;
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
            }, $data),
        );
    }
}

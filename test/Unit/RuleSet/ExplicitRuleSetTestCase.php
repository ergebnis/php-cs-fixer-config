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

use Ergebnis\PhpCsFixer\Config\RuleSet;
use PhpCsFixer\Fixer;
use PhpCsFixer\FixerConfiguration;

abstract class ExplicitRuleSetTestCase extends AbstractRuleSetTestCase
{
    final public function testIsExplicitRuleSet(): void
    {
        $ruleSet = self::createRuleSet();

        self::assertInstanceOf(RuleSet\ExplicitRuleSet::class, $ruleSet);
    }

    final public function testRuleSetDoesNotConfigureRuleSets(): void
    {
        $rules = self::createRuleSet()->rules();

        $rulesWithoutRulesForRuleSets = \array_filter(
            $rules,
            static function (string $nameOfRule): bool {
                return !\str_starts_with($nameOfRule, '@');
            },
            \ARRAY_FILTER_USE_KEY,
        );

        self::assertEquals($rulesWithoutRulesForRuleSets, $rules, \sprintf(
            'Failed asserting that rule set "%s" does not configure rules for rule sets.',
            static::className(),
        ));
    }

    final public function testRuleSetConfiguresAllRulesThatAreNotDeprecated(): void
    {
        $rules = self::createRuleSet()->rules();

        $fixersThatAreBuiltInAndNotDeprecated = \array_filter(self::fixersThatAreBuiltIn(), static function (Fixer\FixerInterface $fixer): bool {
            return !$fixer instanceof Fixer\DeprecatedFixerInterface;
        });

        $rulesThatAreNotDeprecated = \array_combine(
            \array_keys($fixersThatAreBuiltInAndNotDeprecated),
            \array_fill(
                0,
                \count($fixersThatAreBuiltInAndNotDeprecated),
                false,
            ),
        );

        $rulesWithRulesThatAreNotDeprecated = \array_merge(
            $rulesThatAreNotDeprecated,
            $rules,
        );

        self::assertEquals($rulesWithRulesThatAreNotDeprecated, $rules, \sprintf(
            'Failed asserting that rule set "%s" configures all non-deprecated fixers.',
            static::className(),
        ));
    }

    final public function testRuleSetConfiguresAllRulesThatAreConfigurableAndNotDeprecatedWithAnExplicitConfigurationWithEveryOptionWhenTheyAreEnabled(): void
    {
        $rules = self::createRuleSet()->rules();

        $namesOfRules = \array_keys($rules);

        $fixersThatAreBuiltIn = self::fixersThatAreBuiltIn();

        $rulesWithAllNonDeprecatedConfigurationOptions = \array_combine(
            $namesOfRules,
            \array_map(static function (string $nameOfRule, $ruleConfiguration) use ($fixersThatAreBuiltIn) {
                if (false === $ruleConfiguration) {
                    return false;
                }

                $fixer = $fixersThatAreBuiltIn[$nameOfRule];

                if ($fixer instanceof Fixer\DeprecatedFixerInterface) {
                    return $ruleConfiguration;
                }

                if (!$fixer instanceof Fixer\ConfigurableFixerInterface) {
                    return $ruleConfiguration;
                }

                $configurationOptions = $fixer->getConfigurationDefinition()->getOptions();

                $nonDeprecatedConfigurationOptions = \array_filter($configurationOptions, static function (FixerConfiguration\FixerOptionInterface $fixerOption): bool {
                    return !$fixerOption instanceof FixerConfiguration\DeprecatedFixerOptionInterface;
                });

                $ruleConfigurationWithAllNonDeprecatedConfigurationOptionsAndDefaultValues = \array_combine(
                    \array_map(static function (FixerConfiguration\FixerOptionInterface $fixerOption): string {
                        return $fixerOption->getName();
                    }, $nonDeprecatedConfigurationOptions),
                    \array_map(static function (FixerConfiguration\FixerOptionInterface $fixerOption) {
                        if (!$fixerOption->hasDefault()) {
                            return null;
                        }

                        return $fixerOption->getDefault();
                    }, $nonDeprecatedConfigurationOptions),
                );

                if (!\is_array($ruleConfiguration)) {
                    return $ruleConfigurationWithAllNonDeprecatedConfigurationOptionsAndDefaultValues;
                }

                $diff = \array_diff_key(
                    $ruleConfigurationWithAllNonDeprecatedConfigurationOptionsAndDefaultValues,
                    $ruleConfiguration,
                );

                if ([] === $diff) {
                    return $ruleConfiguration;
                }

                return \array_merge(
                    $ruleConfiguration,
                    $diff,
                );
            }, $namesOfRules, $rules),
        );

        self::assertEquals($rulesWithAllNonDeprecatedConfigurationOptions, $rules, \sprintf(
            'Failed asserting that rule set "%s" configures configurable rules using all non-deprecated configuration options.',
            static::className(),
        ));
    }
}

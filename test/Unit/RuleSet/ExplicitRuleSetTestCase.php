<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019-2024 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config\Test\Unit\RuleSet;

use PhpCsFixer\Fixer;
use PhpCsFixer\FixerConfiguration;

abstract class ExplicitRuleSetTestCase extends AbstractRuleSetTestCase
{
    final public function testRuleSetDoesNotConfigureRuleSets(): void
    {
        $ruleSet = static::createRuleSet();

        $rules = $ruleSet->rules();

        $rulesWithoutRulesForRuleSets = \array_filter(
            $rules->toArray(),
            static function (string $nameOfRule): bool {
                return !\str_starts_with($nameOfRule, '@');
            },
            \ARRAY_FILTER_USE_KEY,
        );

        self::assertEquals($rulesWithoutRulesForRuleSets, $rules->toArray(), \sprintf(
            'Failed asserting that rule set "%s" does not configure rules for rule sets.',
            \get_class($ruleSet),
        ));
    }

    final public function testRuleSetConfiguresAllRulesThatAreNotDeprecated(): void
    {
        $ruleSet = static::createRuleSet();

        $rules = $ruleSet->rules();

        $fixersThatAreRegisteredAndNotDeprecated = \array_filter(self::fixersThatAreRegistered(), static function (Fixer\FixerInterface $fixer): bool {
            return !$fixer instanceof Fixer\DeprecatedFixerInterface;
        });

        $rulesThatAreNotDeprecated = \array_combine(
            \array_keys($fixersThatAreRegisteredAndNotDeprecated),
            \array_fill(
                0,
                \count($fixersThatAreRegisteredAndNotDeprecated),
                false,
            ),
        );

        $rulesWithRulesThatAreNotDeprecated = \array_merge(
            $rulesThatAreNotDeprecated,
            $rules->toArray(),
        );

        self::assertEquals($rulesWithRulesThatAreNotDeprecated, $rules->toArray(), \sprintf(
            'Failed asserting that rule set "%s" configures all non-deprecated fixers.',
            \get_class($ruleSet),
        ));
    }

    final public function testRuleSetConfiguresAllRulesThatAreConfigurableAndNotDeprecatedWithAnExplicitConfigurationWithEveryOptionWhenTheyAreEnabled(): void
    {
        $ruleSet = static::createRuleSet();

        $rules = $ruleSet->rules();

        $namesOfRules = \array_keys($rules->toArray());

        $fixersThatAreRegistered = self::fixersThatAreRegistered();

        $rulesWithAllNonDeprecatedConfigurationOptions = \array_combine(
            $namesOfRules,
            \array_map(static function (string $nameOfRule, $ruleConfiguration) use ($fixersThatAreRegistered) {
                if (false === $ruleConfiguration) {
                    return false;
                }

                $fixer = $fixersThatAreRegistered[$nameOfRule];

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

                if ([] === $nonDeprecatedConfigurationOptions) {
                    return true;
                }

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
            }, $namesOfRules, $rules->toArray()),
        );

        self::assertEquals($rulesWithAllNonDeprecatedConfigurationOptions, $rules->toArray(), \sprintf(
            'Failed asserting that rule set "%s" configures configurable rules using all non-deprecated configuration options.',
            \get_class($ruleSet),
        ));
    }
}

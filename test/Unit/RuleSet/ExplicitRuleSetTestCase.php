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

/**
 * @internal
 */
abstract class ExplicitRuleSetTestCase extends AbstractRuleSetTestCase
{
    final public function testIsExplicitRuleSet(): void
    {
        $ruleSet = self::createRuleSet();

        self::assertInstanceOf(Config\RuleSet\ExplicitRuleSet::class, $ruleSet);
    }

    final public function testRuleSetDoesNotConfigureRuleSets(): void
    {
        $namesOfRulesThatAreConfigured = \array_keys(self::createRuleSet()->rules());

        $namesOfRulesThatAreConfiguredAndReferenceRuleSets = \array_filter($namesOfRulesThatAreConfigured, static function (string $ruleName): bool {
            return '@' === \mb_substr($ruleName, 0, 1);
        });

        self::assertEmpty($namesOfRulesThatAreConfiguredAndReferenceRuleSets, \sprintf(
            "Failed asserting that rule set \"%s\" does not configure rule sets. Rule sets with names\n\n%s\n\nshould not be used.",
            static::className(),
            ' - ' . \implode("\n - ", $namesOfRulesThatAreConfiguredAndReferenceRuleSets)
        ));
    }

    final public function testRuleSetConfiguresAllRulesThatAreConfigurableAndNotDeprecatedWithAnExplicitConfigurationWithEveryOptionWhenTheyAreEnabled(): void
    {
        $rules = self::createRuleSet()->rules();

        $namesOfRules = \array_keys($rules);

        $fixersThatAreBuiltIn = self::fixersThatAreBuiltIn();

        $rulesWithAllNonDeprecatedConfigurationOptions = self::sort(\array_combine(
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

                $nonDeprecatedConfigurationOptions = \array_filter($configurationOptions, static function (FixerConfiguration\FixerOptionInterface $fixerOption): bool {
                    return !$fixerOption instanceof FixerConfiguration\DeprecatedFixerOptionInterface;
                });

                $diff = \array_diff_key(
                    \array_combine(
                        \array_map(static function (FixerConfiguration\FixerOptionInterface $fixerOption): string {
                            return $fixerOption->getName();
                        }, $nonDeprecatedConfigurationOptions),
                        \array_map(static function (FixerConfiguration\FixerOptionInterface $fixerOption) {
                            return $fixerOption->getDefault();
                        }, $nonDeprecatedConfigurationOptions)
                    ),
                    $ruleConfiguration
                );

                if ([] === $diff) {
                    return $ruleConfiguration;
                }

                return \array_merge(
                    $ruleConfiguration,
                    $diff
                );
            }, $namesOfRules, $rules)
        ));

        self::assertEquals($rulesWithAllNonDeprecatedConfigurationOptions, $rules, \sprintf(
            'Failed asserting that rule set "%s" configures configurable rules using all non-deprecated configuration options.',
            static::className()
        ));
    }
}

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

    final public function testRuleSetConfiguresAllRulesThatAreConfigurableAndNotDeprecatedWithAnExplicitConfigurationWhenTheyAreEnabled(): void
    {
        $rules = self::createRuleSet()->rules();

        $rulesThatAreConfigurable = \array_intersect_key(
            $rules,
            \array_flip(self::namesOfRulesThatAreBuiltInAndNotDeprecatedAndConfigurable())
        );

        $namesOfRulesThatAreNotDeprecatedEnabledAndNotConfiguredExplicitly = \array_keys(\array_filter($rulesThatAreConfigurable, static function ($configuration): bool {
            return \is_bool($configuration) && false !== $configuration;
        }));

        self::assertEmpty($namesOfRulesThatAreNotDeprecatedEnabledAndNotConfiguredExplicitly, \sprintf(
            "Failed asserting that rule set \"%s\" configures all non-deprecated fixers that are enabled and configurable with an explicit configuration. Rules with the names\n\n%s\n\nare enabled, but not configured explicitly.",
            static::className(),
            ' - ' . \implode("\n - ", $namesOfRulesThatAreNotDeprecatedEnabledAndNotConfiguredExplicitly)
        ));
    }

    /**
     * @return array<int, string>
     */
    private static function namesOfRulesThatAreBuiltInAndNotDeprecatedAndConfigurable(): array
    {
        return \array_keys(\array_filter(self::fixersThatAreBuiltIn(), static function (Fixer\FixerInterface $fixer): bool {
            return !$fixer instanceof Fixer\DeprecatedFixerInterface
                && $fixer instanceof Fixer\ConfigurableFixerInterface;
        }));
    }
}

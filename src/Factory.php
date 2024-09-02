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

namespace Ergebnis\PhpCsFixer\Config;

use PhpCsFixer\Config;
use PhpCsFixer\Runner;

final class Factory
{
    /**
     * Creates a configuration based on a rule set.
     *
     * @throws \RuntimeException
     */
    public static function fromRuleSet(RuleSet $ruleSet, bool $checkCurrentPhpVersion = true): Config
    {
        if ($checkCurrentPhpVersion && ($currentPhpVersion = PhpVersion::current())->isSmallerThan($ruleSet->phpVersion())) {
            throw new \RuntimeException(\sprintf(
                'Current PHP version "%s" is smaller than targeted PHP version "%s".',
                $currentPhpVersion->toString(),
                $ruleSet->phpVersion()->toString(),
            ));
        }

        $config = new Config($ruleSet->name()->toString());

        $config->registerCustomFixers($ruleSet->customFixers()->toArray());
        $config->setParallelConfig(Runner\Parallel\ParallelConfigFactory::detect());
        $config->setRiskyAllowed(true);
        $config->setRules($ruleSet->rules()->toArray());

        return $config;
    }
}

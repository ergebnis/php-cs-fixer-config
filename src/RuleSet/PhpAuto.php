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

namespace Ergebnis\PhpCsFixer\Config\RuleSet;

use Composer\Semver\VersionParser;
use Ergebnis\PhpCsFixer\Config\PhpVersion;
use Ergebnis\PhpCsFixer\Config\RuleSet;

final class PhpAuto implements PhpRuleSet
{
    /**
     * @throws \InvalidArgumentException|\JsonException|\RuntimeException
     */
    public static function create(): RuleSet
    {
        $composerFile = \getcwd() . \DIRECTORY_SEPARATOR . 'composer.json';
        $phpVersion = self::getMinimumVersion(self::findPhpVersionSpec($composerFile));
        $ruleSetClass = __NAMESPACE__ . "\\Php{$phpVersion->toLanguageLevelInt()}";

        if (!\class_exists($ruleSetClass)) {
            throw new \RuntimeException(
                "Class `{$ruleSetClass}` not found: It is likely that no ruleset for PHP {$phpVersion->toString()} has been defined yet",
            );
        }

        if (!\is_a($ruleSetClass, PhpRuleSet::class, true)) {
            throw new \RuntimeException("Class `{$ruleSetClass}` does not implement the `PhpRuleSet` interface");
        }

        return $ruleSetClass::create();
    }

    /**
     * @throws \InvalidArgumentException
     * @throws \JsonException
     */
    private static function findPhpVersionSpec(string $file): string
    {
        if (!\file_exists($file)) {
            throw new \RuntimeException("Composer file not found at {$file}");
        }

        $contents = \file_get_contents($file);

        if (false === $contents) {
            throw new \InvalidArgumentException("Composer config file is empty at {$file}");
        }

        $config = \json_decode($contents, false, 512, \JSON_THROW_ON_ERROR);

        if (!\is_object($config)) {
            throw new \InvalidArgumentException('Composer config should be an object, ' . \gettype($config) . " found in {$file}");
        }

        if (!\is_object($config->require)) {
            throw new \InvalidArgumentException('The `require` section in the Composer config should be an object, ' . \gettype($config->require) . " found in {$file}");
        }

        if (!isset($config->require->php)) {
            throw new \InvalidArgumentException("PHP has not been configured as a requirement in {$file}");
        }

        if (!\is_string($config->require->php)) {
            throw new \InvalidArgumentException('PHP version should be a string, ' . \gettype($config->require->php) . " found in {$file}");
        }

        return $config->require->php;
    }

    private static function getMinimumVersion(string $versionSpec): PhpVersion
    {
        return PhpVersion::fromString(
            (new VersionParser())
                ->parseConstraints($versionSpec)
                ->getLowerBound()
                ->getVersion(),
        );
    }
}

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

use Ergebnis\PhpCsFixer\Config\Factory;
use Ergebnis\PhpCsFixer\Config\Name;
use Ergebnis\PhpCsFixer\Config\PhpVersion;
use Ergebnis\PhpCsFixer\Config\RuleSet;
use PhpCsFixer\Fixer;
use PhpCsFixer\FixerConfiguration;
use PhpCsFixer\FixerFactory;
use PHPUnit\Framework;

abstract class AbstractRuleSetTestCase extends Framework\TestCase
{
    /**
     * A list of tags that should be ignored by fixers related to Doctrine.
     *
     * @see https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/v3.1.0/doc/rules/doctrine_annotation/doctrine_annotation_array_assignment.rst
     * @see https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/v3.1.0/doc/rules/doctrine_annotation/doctrine_annotation_braces.rst
     * @see https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/v3.1.0/doc/rules/doctrine_annotation/doctrine_annotation_indentation.rst
     * @see https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/v3.1.0/doc/rules/doctrine_annotation/doctrine_annotation_spaces.rst
     */
    protected const DOCTRINE_IGNORED_TAGS = [
        'abstract',
        'access',
        'after',
        'afterClass',
        'api',
        'author',
        'backupGlobals',
        'backupStaticAttributes',
        'before',
        'beforeClass',
        'category',
        'code',
        'codeCoverageIgnore',
        'codeCoverageIgnoreEnd',
        'codeCoverageIgnoreStart',
        'copyright',
        'covers',
        'coversDefaultClass',
        'coversNothing',
        'dataProvider',
        'depends',
        'deprec',
        'deprecated',
        'encode',
        'enduml',
        'example',
        'exception',
        'expectedException',
        'expectedExceptionCode',
        'expectedExceptionMessage',
        'expectedExceptionMessageRegExp',
        'filesource',
        'final',
        'fix',
        'FIXME',
        'fixme',
        'global',
        'group',
        'ignore',
        'ingroup',
        'inheritdoc',
        'inheritDoc',
        'internal',
        'large',
        'license',
        'link',
        'magic',
        'medium',
        'method',
        'name',
        'noinspection',
        'override',
        'package',
        'package_version',
        'param',
        'preserveGlobalState',
        'private',
        'property',
        'property-read',
        'property-write',
        'requires',
        'return',
        'runInSeparateProcess',
        'runTestsInSeparateProcesses',
        'see',
        'since',
        'small',
        'source',
        'startuml',
        'static',
        'staticvar',
        'staticVar',
        'subpackage',
        'SuppressWarnings',
        'template',
        'test',
        'testdox',
        'throw',
        'throws',
        'ticket',
        'toc',
        'todo',
        'TODO',
        'tutorial',
        'usedBy',
        'uses',
        'uses',
        'var',
        'version',
    ];

    final public function testDefaults(): void
    {
        $ruleSet = self::createRuleSet();

        self::assertEquals($this->expectedName(), $ruleSet->name());
        self::assertEquals($this->expectedRules(), $ruleSet->rules());
        self::assertEquals($this->expectedTargetPhpVersion(), $ruleSet->targetPhpVersion());
    }

    final public function testRuleSetDoesNotConfigureRulesThatAreNotRegistered(): void
    {
        $rules = self::createRuleSet()->rules();

        $fixersThatAreRegistered = self::fixersThatAreRegistered();

        $rulesWithoutRulesThatAreNotRegistered = \array_filter(
            $rules,
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

        self::assertEquals($rulesWithoutRulesThatAreNotRegistered, $rules, \sprintf(
            'Failed asserting that rule set "%s" does not configure rules that are not registered.',
            static::className(),
        ));
    }

    final public function testRuleSetDoesNotConfigureRulesThatAreDeprecated(): void
    {
        $rules = self::createRuleSet()->rules();

        $fixersThatAreRegistered = self::fixersThatAreRegistered();

        $rulesWithoutRulesThatAreDeprecated = \array_filter(
            $rules,
            static function (string $nameOfRule) use ($fixersThatAreRegistered): bool {
                if (!\array_key_exists($nameOfRule, $fixersThatAreRegistered)) {
                    return true;
                }

                $fixer = $fixersThatAreRegistered[$nameOfRule];

                return !$fixer instanceof Fixer\DeprecatedFixerInterface;
            },
            \ARRAY_FILTER_USE_KEY,
        );

        self::assertEquals($rulesWithoutRulesThatAreDeprecated, $rules, \sprintf(
            'Failed asserting that rule set "%s" does not configure rules that are deprecated.',
            static::className(),
        ));
    }

    final public function testRuleSetDoesNotConfigureRulesUsingDeprecatedConfigurationOptions(): void
    {
        $rules = self::createRuleSet()->rules();

        $namesOfRules = \array_keys($rules);

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
            }, $namesOfRules, $rules),
        );

        self::assertEquals($rulesWithoutDeprecatedConfigurationOptions, $rules, \sprintf(
            'Failed asserting that rule set "%s" does not configure rules using deprecated configuration options.',
            static::className(),
        ));
    }

    final public function testRulesAndConfigurationOptionsAreSortedInRuleSet(): void
    {
        $rules = self::createRuleSet()->rules();

        $sorted = self::sort($rules);

        self::assertSame($sorted, $rules, \sprintf(
            'Failed asserting that rules and configuration options are sorted by name in rule set "%s".',
            static::className(),
        ));
    }

    final public function testRulesAndConfigurationOptionsAreSortedInRuleSetTest(): void
    {
        $rules = $this->expectedRules();

        $sorted = self::sort($rules);

        self::assertSame($sorted, $rules, \sprintf(
            'Failed asserting that rules and configuration options are sorted by name in rule set test "%s".',
            static::class,
        ));
    }

    final public function testHeaderCommentFixerIsDisabledByDefault(): void
    {
        $rules = self::createRuleSet()->rules();

        self::assertArrayHasKey('header_comment', $rules);
        self::assertFalse($rules['header_comment']);
    }

    #[Framework\Attributes\DataProvider('provideValidHeader')]
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

        self::assertEquals($expected, $rules['header_comment']);
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

    abstract protected function expectedName(): Name;

    abstract protected function expectedRules(): array;

    abstract protected function expectedTargetPhpVersion(): PhpVersion;

    /**
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
                static::class,
            ),
        );

        if (!\is_string($className)) {
            throw new \RuntimeException(\sprintf(
                'Failed resolving class name from test class name "%s".',
                static::class,
            ));
        }

        if (!\class_exists($className)) {
            throw new \RuntimeException(\sprintf(
                'Class name "%s" resolved from test class name "%s" does not reference a class that exists.',
                $className,
                static::class,
            ));
        }

        return $className;
    }

    /**
     * @throws \RuntimeException
     */
    final protected static function createRuleSet(?string $header = null): RuleSet
    {
        $className = self::className();

        $reflection = new \ReflectionClass($className);

        $ruleSet = $reflection->newInstance($header);

        if (!$ruleSet instanceof RuleSet) {
            throw new \RuntimeException(\sprintf(
                'Class %s" does not implement interface "%s".',
                $className,
                RuleSet::class,
            ));
        }

        return $ruleSet;
    }

    /**
     * @return array<string, Fixer\FixerInterface>
     */
    final protected static function fixersThatAreRegistered(): array
    {
        $fixerFactory = new FixerFactory();

        $fixerFactory->registerBuiltInFixers();

        $fixers = \array_merge(
            $fixerFactory->getFixers(),
            Factory::fromRuleSet(self::createRuleSet())->getCustomFixers(),
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

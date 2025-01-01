<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019-2025 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config\Test\Unit;

use Ergebnis\PhpCsFixer\Config\Factory;
use Ergebnis\PhpCsFixer\Config\Fixers;
use Ergebnis\PhpCsFixer\Config\Name;
use Ergebnis\PhpCsFixer\Config\PhpVersion;
use Ergebnis\PhpCsFixer\Config\Rules;
use Ergebnis\PhpCsFixer\Config\RuleSet;
use Ergebnis\PhpCsFixer\Config\Test;
use PhpCsFixer\Fixer;
use PhpCsFixer\Runner;
use PHPUnit\Framework;

/**
 * @covers \Ergebnis\PhpCsFixer\Config\Factory
 *
 * @uses \Ergebnis\PhpCsFixer\Config\Fixers
 * @uses \Ergebnis\PhpCsFixer\Config\Name
 * @uses \Ergebnis\PhpCsFixer\Config\PhpVersion
 * @uses \Ergebnis\PhpCsFixer\Config\PhpVersion\Major
 * @uses \Ergebnis\PhpCsFixer\Config\PhpVersion\Minor
 * @uses \Ergebnis\PhpCsFixer\Config\PhpVersion\Patch
 * @uses \Ergebnis\PhpCsFixer\Config\Rules
 * @uses \Ergebnis\PhpCsFixer\Config\RuleSet
 */
final class FactoryTest extends Framework\TestCase
{
    use Test\Util\Helper;

    public function testFromRuleSetThrowsRuntimeExceptionWhenCurrentPhpVersionIsLessThanTargetPhpVersion(): void
    {
        $phpVersion = PhpVersion::create(
            PhpVersion\Major::fromInt(\PHP_MAJOR_VERSION),
            PhpVersion\Minor::fromInt(\PHP_MINOR_VERSION),
            PhpVersion\Patch::fromInt(\PHP_RELEASE_VERSION + 1),
        );

        $ruleSet = RuleSet::create(
            Fixers::empty(),
            Name::fromString(self::faker()->word()),
            $phpVersion,
            Rules::fromArray([]),
        );

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(\sprintf(
            'Current PHP version "%s" is smaller than targeted PHP version "%s".',
            PhpVersion::current()->toString(),
            $phpVersion->toString(),
        ));

        Factory::fromRuleSet($ruleSet);
    }

    /**
     * @dataProvider provideTargetPhpVersionLessThanOrEqualToCurrentPhpVersion
     */
    public function testFromRuleSetCreatesConfigWhenCurrentPhpVersionIsEqualToOrGreaterThanTargetPhpVersion(PhpVersion $targetPhpVersion): void
    {
        $customFixers = Fixers::fromFixers(
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
        );

        $rules = Rules::fromArray([
            'foo' => true,
            'bar' => [
                'baz' => true,
            ],
        ]);

        $ruleSet = RuleSet::create(
            $customFixers,
            Name::fromString(self::faker()->word()),
            $targetPhpVersion,
            $rules,
        );

        $config = Factory::fromRuleSet($ruleSet);

        self::assertEquals($customFixers->toArray(), $config->getCustomFixers());
        self::assertEquals(Runner\Parallel\ParallelConfigFactory::detect(), $config->getParallelConfig());
        self::assertTrue($config->getRiskyAllowed());
        self::assertSame($rules->toArray(), $config->getRules());
        self::assertTrue($config->getUsingCache());
    }

    /**
     * @return \Generator<int, array{0: PhpVersion}>
     */
    public static function provideTargetPhpVersionLessThanOrEqualToCurrentPhpVersion(): iterable
    {
        $values = [
            PhpVersion::fromInt(\PHP_VERSION_ID - 1),
            PhpVersion::fromInt(\PHP_VERSION_ID),
        ];

        foreach ($values as $value) {
            yield [
                $value,
            ];
        }
    }
}

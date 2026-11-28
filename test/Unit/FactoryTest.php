<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019-2026 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config\Test\Unit;

use Ergebnis\PhpCsFixer;
use Ergebnis\PhpCsFixer\Config;
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
 *
 * @no-named-arguments
 */
final class FactoryTest extends Framework\TestCase
{
    use Config\Test\Util\Helper;

    public function testFromRuleSetThrowsRuntimeExceptionWhenCurrentPhpVersionIsLessThanTargetPhpVersion(): void
    {
        $phpVersion = Config\PhpVersion::create(
            Config\PhpVersion\Major::fromInt(\PHP_MAJOR_VERSION),
            Config\PhpVersion\Minor::fromInt(\PHP_MINOR_VERSION),
            Config\PhpVersion\Patch::fromInt(\PHP_RELEASE_VERSION + 1),
        );

        $ruleSet = Config\RuleSet::create(
            Config\Fixers::empty(),
            Config\Name::fromString(self::faker()->word()),
            $phpVersion,
            Config\Rules::fromArray([]),
        );

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(\sprintf(
            'Current PHP version "%s" is less than targeted PHP version "%s".',
            Config\PhpVersion::current()->toString(),
            $phpVersion->toString(),
        ));

        Config\Factory::fromRuleSet($ruleSet);
    }

    /**
     * @dataProvider provideTargetPhpVersionLessThanOrEqualToCurrentPhpVersion
     */
    public function testFromRuleSetCreatesConfigWhenCurrentPhpVersionIsEqualToOrGreaterThanTargetPhpVersion(Config\PhpVersion $targetPhpVersion): void
    {
        $customFixers = Config\Fixers::fromFixers(
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
        );

        $rules = Config\Rules::fromArray([
            'bar' => [
                'baz' => true,
            ],
            'foo' => true,
        ]);

        $ruleSet = Config\RuleSet::create(
            $customFixers,
            Config\Name::fromString(self::faker()->word()),
            $targetPhpVersion,
            $rules,
        );

        $config = Config\Factory::fromRuleSet($ruleSet);

        self::assertEquals($customFixers->toArray(), $config->getCustomFixers());
        self::assertEquals(Runner\Parallel\ParallelConfigFactory::detect(), $config->getParallelConfig());
        self::assertTrue($config->getRiskyAllowed());
        self::assertSame($rules->toArray(), $config->getRules());
        self::assertTrue($config->getUsingCache());
    }

    /**
     * @return \Generator<int, array{0: Config\PhpVersion}>
     */
    public static function provideTargetPhpVersionLessThanOrEqualToCurrentPhpVersion(): iterable
    {
        $values = [
            Config\PhpVersion::fromInt(\PHP_VERSION_ID - 1),
            Config\PhpVersion::fromInt(\PHP_VERSION_ID),
        ];

        foreach ($values as $value) {
            yield [
                $value,
            ];
        }
    }
}

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
    use PhpCsFixer\Config\Test\Util\Helper;

    public function testFromRuleSetThrowsRuntimeExceptionWhenCurrentPhpVersionIsLessThanTargetPhpVersion(): void
    {
        $phpVersion = PhpCsFixer\Config\PhpVersion::create(
            PhpCsFixer\Config\PhpVersion\Major::fromInt(\PHP_MAJOR_VERSION),
            PhpCsFixer\Config\PhpVersion\Minor::fromInt(\PHP_MINOR_VERSION),
            PhpCsFixer\Config\PhpVersion\Patch::fromInt(\PHP_RELEASE_VERSION + 1),
        );

        $ruleSet = PhpCsFixer\Config\RuleSet::create(
            PhpCsFixer\Config\Fixers::empty(),
            PhpCsFixer\Config\Name::fromString(self::faker()->word()),
            $phpVersion,
            PhpCsFixer\Config\Rules::fromArray([]),
        );

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage(\sprintf(
            'Current PHP version "%s" is smaller than targeted PHP version "%s".',
            PhpCsFixer\Config\PhpVersion::current()->toString(),
            $phpVersion->toString(),
        ));

        PhpCsFixer\Config\Factory::fromRuleSet($ruleSet);
    }

    /**
     * @dataProvider provideTargetPhpVersionLessThanOrEqualToCurrentPhpVersion
     */
    public function testFromRuleSetCreatesConfigWhenCurrentPhpVersionIsEqualToOrGreaterThanTargetPhpVersion(PhpCsFixer\Config\PhpVersion $targetPhpVersion): void
    {
        $customFixers = PhpCsFixer\Config\Fixers::fromFixers(
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
        );

        $rules = PhpCsFixer\Config\Rules::fromArray([
            'bar' => [
                'baz' => true,
            ],
            'foo' => true,
        ]);

        $ruleSet = PhpCsFixer\Config\RuleSet::create(
            $customFixers,
            PhpCsFixer\Config\Name::fromString(self::faker()->word()),
            $targetPhpVersion,
            $rules,
        );

        $config = PhpCsFixer\Config\Factory::fromRuleSet($ruleSet);

        self::assertEquals($customFixers->toArray(), $config->getCustomFixers());
        self::assertEquals(Runner\Parallel\ParallelConfigFactory::detect(), $config->getParallelConfig());
        self::assertTrue($config->getRiskyAllowed());
        self::assertSame($rules->toArray(), $config->getRules());
        self::assertTrue($config->getUsingCache());
    }

    /**
     * @return \Generator<int, array{0: PhpCsFixer\Config\PhpVersion}>
     */
    public static function provideTargetPhpVersionLessThanOrEqualToCurrentPhpVersion(): iterable
    {
        $values = [
            PhpCsFixer\Config\PhpVersion::fromInt(\PHP_VERSION_ID - 1),
            PhpCsFixer\Config\PhpVersion::fromInt(\PHP_VERSION_ID),
        ];

        foreach ($values as $value) {
            yield [
                $value,
            ];
        }
    }
}

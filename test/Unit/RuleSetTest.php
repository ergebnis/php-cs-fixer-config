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
use PHPUnit\Framework;

/**
 * @covers \Ergebnis\PhpCsFixer\Config\RuleSet
 *
 * @uses \Ergebnis\PhpCsFixer\Config\Fixers
 * @uses \Ergebnis\PhpCsFixer\Config\Name
 * @uses \Ergebnis\PhpCsFixer\Config\PhpVersion
 * @uses \Ergebnis\PhpCsFixer\Config\PhpVersion\Major
 * @uses \Ergebnis\PhpCsFixer\Config\PhpVersion\Minor
 * @uses \Ergebnis\PhpCsFixer\Config\PhpVersion\Patch
 * @uses \Ergebnis\PhpCsFixer\Config\Rules
 *
 * @no-named-arguments
 */
final class RuleSetTest extends Framework\TestCase
{
    use PhpCsFixer\Config\Test\Util\Helper;

    public function testCreateReturnsRuleSet(): void
    {
        $faker = self::faker();

        $customFixers = PhpCsFixer\Config\Fixers::fromFixers(
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
        );
        $name = PhpCsFixer\Config\Name::fromString($faker->word());
        $phpVersion = PhpCsFixer\Config\PhpVersion::create(
            PhpCsFixer\Config\PhpVersion\Major::fromInt($faker->numberBetween(0)),
            PhpCsFixer\Config\PhpVersion\Minor::fromInt($faker->numberBetween(0, 99)),
            PhpCsFixer\Config\PhpVersion\Patch::fromInt($faker->numberBetween(0, 99)),
        );
        $rules = PhpCsFixer\Config\Rules::fromArray([
            'header_comment' => false,
        ]);

        $ruleSet = PhpCsFixer\Config\RuleSet::create(
            $customFixers,
            $name,
            $phpVersion,
            $rules,
        );

        self::assertSame($customFixers, $ruleSet->customFixers());
        self::assertSame($name, $ruleSet->name());
        self::assertSame($phpVersion, $ruleSet->phpVersion());
        self::assertSame($rules, $ruleSet->rules());
    }

    public function testWithCustomFixersReturnsRuleSetWithMergedCustomFixers(): void
    {
        $faker = self::faker();

        $customFixers = PhpCsFixer\Config\Fixers::fromFixers(
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
        );

        $ruleSet = PhpCsFixer\Config\RuleSet::create(
            PhpCsFixer\Config\Fixers::fromFixers(
                $this->createStub(Fixer\FixerInterface::class),
                $this->createStub(Fixer\FixerInterface::class),
                $this->createStub(Fixer\FixerInterface::class),
            ),
            PhpCsFixer\Config\Name::fromString($faker->word()),
            PhpCsFixer\Config\PhpVersion::create(
                PhpCsFixer\Config\PhpVersion\Major::fromInt($faker->numberBetween(0)),
                PhpCsFixer\Config\PhpVersion\Minor::fromInt($faker->numberBetween(0, 99)),
                PhpCsFixer\Config\PhpVersion\Patch::fromInt($faker->numberBetween(0, 99)),
            ),
            PhpCsFixer\Config\Rules::fromArray([
                'foo' => false,
                'quz' => true,
            ]),
        );

        $mutated = $ruleSet->withCustomFixers($customFixers);

        self::assertNotSame($ruleSet, $mutated);

        $expected = $ruleSet->customFixers()->merge($customFixers);

        self::assertEquals($expected, $mutated->customFixers());
        self::assertEquals($ruleSet->name(), $mutated->name());
        self::assertEquals($ruleSet->phpVersion(), $mutated->phpVersion());
        self::assertEquals($ruleSet->rules(), $mutated->rules());
    }

    public function testWithRulesReturnsRuleSetWithMergedRules(): void
    {
        $faker = self::faker();

        $rules = PhpCsFixer\Config\Rules::fromArray([
            'bar' => false,
            'foo' => true,
        ]);

        $ruleSet = PhpCsFixer\Config\RuleSet::create(
            PhpCsFixer\Config\Fixers::fromFixers(
                $this->createStub(Fixer\FixerInterface::class),
                $this->createStub(Fixer\FixerInterface::class),
                $this->createStub(Fixer\FixerInterface::class),
            ),
            PhpCsFixer\Config\Name::fromString($faker->word()),
            PhpCsFixer\Config\PhpVersion::create(
                PhpCsFixer\Config\PhpVersion\Major::fromInt($faker->numberBetween(0)),
                PhpCsFixer\Config\PhpVersion\Minor::fromInt($faker->numberBetween(0, 99)),
                PhpCsFixer\Config\PhpVersion\Patch::fromInt($faker->numberBetween(0, 99)),
            ),
            PhpCsFixer\Config\Rules::fromArray([
                'foo' => false,
                'quz' => true,
            ]),
        );

        $mutated = $ruleSet->withRules($rules);

        self::assertNotSame($ruleSet, $mutated);

        self::assertEquals($ruleSet->customFixers(), $mutated->customFixers());
        self::assertEquals($ruleSet->name(), $mutated->name());
        self::assertEquals($ruleSet->phpVersion(), $mutated->phpVersion());

        $expected = $ruleSet->rules()->merge($rules);

        self::assertEquals($expected, $mutated->rules());
    }

    /**
     * @dataProvider provideValidHeader
     */
    public function testWithHeaderReturnsRuleSetWithEnabledHeaderCommentFixer(string $header): void
    {
        $faker = self::faker();

        $ruleSet = PhpCsFixer\Config\RuleSet::create(
            PhpCsFixer\Config\Fixers::fromFixers(
                $this->createStub(Fixer\FixerInterface::class),
                $this->createStub(Fixer\FixerInterface::class),
                $this->createStub(Fixer\FixerInterface::class),
            ),
            PhpCsFixer\Config\Name::fromString($faker->word()),
            PhpCsFixer\Config\PhpVersion::create(
                PhpCsFixer\Config\PhpVersion\Major::fromInt($faker->numberBetween(0)),
                PhpCsFixer\Config\PhpVersion\Minor::fromInt($faker->numberBetween(0, 99)),
                PhpCsFixer\Config\PhpVersion\Patch::fromInt($faker->numberBetween(0, 99)),
            ),
            PhpCsFixer\Config\Rules::fromArray([
                'foo' => false,
                'header_comment' => false,
                'quz' => true,
            ]),
        );

        $mutated = $ruleSet->withHeader($header);

        self::assertNotSame($ruleSet, $mutated);

        self::assertEquals($ruleSet->customFixers(), $mutated->customFixers());
        self::assertEquals($ruleSet->name(), $mutated->name());
        self::assertEquals($ruleSet->phpVersion(), $mutated->phpVersion());

        $expected = $ruleSet->rules()->merge(PhpCsFixer\Config\Rules::fromArray([
            'header_comment' => [
                'comment_type' => 'PHPDoc',
                'header' => \trim($header),
                'location' => 'after_declare_strict',
                'separate' => 'both',
            ],
        ]));

        self::assertEquals($expected, $mutated->rules());
    }

    /**
     * @return \Generator<string, array{0: string}>
     */
    public static function provideValidHeader(): iterable
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
}

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

use Ergebnis\PhpCsFixer\Config\Fixers;
use Ergebnis\PhpCsFixer\Config\Test;
use PhpCsFixer\Fixer;
use PHPUnit\Framework;

/**
 * @covers \Ergebnis\PhpCsFixer\Config\Fixers
 *
 * @no-named-arguments
 */
final class FixersTest extends Framework\TestCase
{
    use Test\Util\Helper;

    public function testEmptyReturnsFixers(): void
    {
        $fixers = Fixers::empty();

        self::assertSame([], $fixers->toArray());
    }

    public function testFromFixersReturnsFixers(): void
    {
        $value = [
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
        ];

        $fixers = Fixers::fromFixers(...$value);

        self::assertSame($value, $fixers->toArray());
    }

    public function testFromIterableRejectsIterableWhenItIsASimpleType(): void
    {
        $iterable = self::faker()->word();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(\sprintf(
            'Expected iterable to be an array or implement %s, got string instead.',
            \Traversable::class,
        ));

        Fixers::fromIterable($iterable);
    }

    public function testFromIterableRejectsIterableWhenItIsNotATraversable(): void
    {
        $iterable = new \stdClass();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(\sprintf(
            'Expected iterable to be an array or implement %s, got %s instead.',
            \Traversable::class,
            \stdClass::class,
        ));

        Fixers::fromIterable($iterable);
    }

    public function testFromIterableRejectsIterableWhenItDoesNotContainFixersOnly(): void
    {
        $iterable = [
            $this->createStub(Fixer\FixerInterface::class),
            new \stdClass(),
            $this->createStub(Fixer\FixerInterface::class),
        ];

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(\sprintf(
            'Expected iterable to contain only instances of %s, got %s instead.',
            Fixer\FixerInterface::class,
            \stdClass::class,
        ));

        Fixers::fromIterable($iterable);
    }

    public function testFromIterableReturnsFixersWhenValueIsArray(): void
    {
        $value = [
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
        ];

        $fixers = Fixers::fromIterable($value);

        self::assertSame($value, $fixers->toArray());
    }

    public function testFromIterableReturnsFixersWhenValueIsTraversable(): void
    {
        $value = [
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
        ];

        $iterable = new \ArrayIterator($value);

        $fixers = Fixers::fromIterable($iterable);

        self::assertSame($value, $fixers->toArray());
    }

    public function testMergeReturnsFixersMergedWithFixers(): void
    {
        $one = Fixers::fromFixers(
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
        );

        $two = Fixers::fromFixers(
            $this->createStub(Fixer\FixerInterface::class),
            $this->createStub(Fixer\FixerInterface::class),
        );

        $mutated = $one->merge($two);

        self::assertNotSame($one, $mutated);
        self::assertNotSame($two, $mutated);

        $expected = Fixers::fromFixers(...\array_merge(
            $one->toArray(),
            $two->toArray(),
        ));

        self::assertEquals($expected, $mutated);
    }
}

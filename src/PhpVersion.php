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

namespace Ergebnis\PhpCsFixer\Config;

/**
 * @no-named-arguments
 */
final class PhpVersion
{
    private PhpVersion\Major $major;
    private PhpVersion\Minor $minor;
    private PhpVersion\Patch $patch;

    private function __construct(
        PhpVersion\Major $major,
        PhpVersion\Minor $minor,
        PhpVersion\Patch $patch
    ) {
        $this->major = $major;
        $this->minor = $minor;
        $this->patch = $patch;
    }

    public static function create(
        PhpVersion\Major $major,
        PhpVersion\Minor $minor,
        PhpVersion\Patch $patch
    ): self {
        return new self(
            $major,
            $minor,
            $patch,
        );
    }

    public static function current(): self
    {
        return new self(
            PhpVersion\Major::fromInt(\PHP_MAJOR_VERSION),
            PhpVersion\Minor::fromInt(\PHP_MINOR_VERSION),
            PhpVersion\Patch::fromInt(\PHP_RELEASE_VERSION),
        );
    }

    /**
     * @throws \InvalidArgumentException
     */
    public static function fromInt(int $value): self
    {
        if (0 > $value) {
            throw new \InvalidArgumentException(\sprintf(
                'Value needs to be greater than or equal to 0, but %d is not.',
                $value,
            ));
        }

        $major = \intdiv(
            $value,
            10_000,
        );

        $minor = \intdiv(
            $value - $major * 10_000,
            100,
        );

        $patch = $value - $major * 10_000 - $minor * 100;

        return new self(
            PhpVersion\Major::fromInt($major),
            PhpVersion\Minor::fromInt($minor),
            PhpVersion\Patch::fromInt($patch),
        );
    }

    public function major(): PhpVersion\Major
    {
        return $this->major;
    }

    public function minor(): PhpVersion\Minor
    {
        return $this->minor;
    }

    public function patch(): PhpVersion\Patch
    {
        return $this->patch;
    }

    public function toInt(): int
    {
        return $this->major->toInt() * 10_000 + $this->minor->toInt() * 100 + $this->patch->toInt();
    }

    public function toString(): string
    {
        return \sprintf(
            '%d.%d.%d',
            $this->major->toInt(),
            $this->minor->toInt(),
            $this->patch->toInt(),
        );
    }

    public function isSmallerThan(self $other): bool
    {
        return $this->toInt() < $other->toInt();
    }
}

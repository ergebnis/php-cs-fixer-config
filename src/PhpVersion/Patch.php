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

namespace Ergebnis\PhpCsFixer\Config\PhpVersion;

/**
 * @no-named-arguments
 */
final class Patch
{
    private int $value;

    private function __construct(int $value)
    {
        $this->value = $value;
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

        if (99 < $value) {
            throw new \InvalidArgumentException(\sprintf(
                'Value needs to be less than or equal to 99, but %d is not.',
                $value,
            ));
        }

        return new self($value);
    }

    public function toInt(): int
    {
        return $this->value;
    }
}

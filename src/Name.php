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
final class Name
{
    private string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @throws \InvalidArgumentException
     */
    public static function fromString(string $value): self
    {
        if ('' === \trim($value)) {
            throw new \InvalidArgumentException('Value can not be blank or empty.');
        }

        return new self($value);
    }

    public function toString(): string
    {
        return $this->value;
    }
}

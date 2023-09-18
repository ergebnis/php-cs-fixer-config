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

namespace Ergebnis\PhpCsFixer\Config;

final class Rules
{
    private readonly array $value;

    /**
     * @param array<string, array<string, mixed>|bool> $value
     */
    private function __construct(array $value)
    {
        $this->value = $value;
    }

    public static function empty(): self
    {
        return new self([]);
    }

    /**
     * @param array<string, array<string, mixed>|bool> $value
     */
    public static function fromArray(array $value): self
    {
        return new self($value);
    }

    /**
     * @return array<string, array<string, mixed>|bool>
     */
    public function toArray(): array
    {
        return $this->value;
    }

    public function merge(self $other): self
    {
        return new self(\array_merge(
            $this->value,
            $other->value,
        ));
    }
}

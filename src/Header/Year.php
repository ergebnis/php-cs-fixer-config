<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config\Header;

/**
 * @internal
 */
final class Year
{
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param string $value
     *
     * @throws \InvalidArgumentException
     *
     * @return self
     */
    public static function fromString(string $value): self
    {
        if (1 !== \preg_match('/^\d{4}$/', $value)) {
            throw new \InvalidArgumentException(\sprintf(
                'Value "%s" does not appear to be a valid year.',
                $value
            ));
        }

        return new self($value);
    }

    public function toString(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value === $other->value;
    }

    public function greaterThan(self $other): bool
    {
        return $this->value > $other->value;
    }
}

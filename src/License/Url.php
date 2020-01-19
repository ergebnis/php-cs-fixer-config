<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019-2020 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config\License;

/**
 * @internal
 */
final class Url
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
        $trimmed = \trim($value);

        if (false === \filter_var($trimmed, \FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException(\sprintf(
                'Value "%s" does not appear to be a valid URL.',
                $value
            ));
        }

        return new self($trimmed);
    }

    public function toString(): string
    {
        return $this->value;
    }
}

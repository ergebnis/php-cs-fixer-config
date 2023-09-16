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

final class Name
{
    private readonly string $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function fromPhpVersion(PhpVersion $phpVersion): self
    {
        return new self(\sprintf(
            'ergebnis (PHP %d.%d)',
            $phpVersion->major()->toInt(),
            $phpVersion->minor()->toInt(),
        ));
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

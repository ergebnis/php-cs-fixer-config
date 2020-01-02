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
final class CopyrightYears
{
    private $value;

    private function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @param Year $startYear
     * @param Year $endYear
     *
     * @throws \InvalidArgumentException
     *
     * @return self
     */
    public static function fromRange(Year $startYear, Year $endYear): self
    {
        if ($startYear->greaterThan($endYear)) {
            throw new \InvalidArgumentException(\sprintf(
                'Start year "%s" needs to be equal to or less than end year "%s".',
                $startYear->toString(),
                $endYear->toString()
            ));
        }

        if ($startYear->equals($endYear)) {
            return self::fromYear($startYear);
        }

        return new self(\sprintf(
            '%s-%s',
            $startYear->toString(),
            $endYear->toString()
        ));
    }

    public static function fromYear(Year $year): self
    {
        return new self($year->toString());
    }

    public function toString(): string
    {
        return $this->value;
    }
}

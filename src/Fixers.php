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

use PhpCsFixer\Fixer;

final class Fixers
{
    /**
     * @var list<Fixer\FixerInterface>
     */
    private array $value;

    private function __construct(Fixer\FixerInterface ...$value)
    {
        $this->value = $value;
    }

    public static function empty(): self
    {
        return new self();
    }

    public static function fromFixers(Fixer\FixerInterface ...$value): self
    {
        return new self(...$value);
    }

    /**
     * @param iterable<Fixer\FixerInterface> $iterable
     *
     * @throws \InvalidArgumentException
     */
    public static function fromIterable($iterable): self
    {
        if (!\is_array($iterable) && !$iterable instanceof \Traversable) {
            throw new \InvalidArgumentException(\sprintf(
                'Expected iterable to be an array or implement %s, got %s instead.',
                \Traversable::class,
                \is_object($iterable) ? \get_class($iterable) : \gettype($iterable),
            ));
        }

        $value = [];

        foreach ($iterable as $iterated) {
            if (!$iterated instanceof Fixer\FixerInterface) {
                throw new \InvalidArgumentException(\sprintf(
                    'Expected iterable to contain only instances of %s, got %s instead.',
                    Fixer\FixerInterface::class,
                    \is_object($iterated) ? \get_class($iterated) : \gettype($iterated),
                ));
            }

            $value[] = $iterated;
        }

        return new self(...$value);
    }

    /**
     * @return list<Fixer\FixerInterface>
     */
    public function toArray(): array
    {
        return $this->value;
    }

    public function merge(self $customFixers): self
    {
        return new self(...\array_merge(
            $this->value,
            $customFixers->value,
        ));
    }
}

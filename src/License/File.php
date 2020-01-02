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

namespace Ergebnis\PhpCsFixer\Config\License;

/**
 * @internal
 */
final class File
{
    private $years;

    private $holder;

    private $template;

    private function __construct(Copyright\Years $years, Copyright\Holder $holder, Template $template)
    {
        $this->years = $years;
        $this->holder = $holder;
        $this->template = $template;
    }

    public static function create(Copyright\Years $years, Copyright\Holder $holder, Template $template): self
    {
        return new self(
            $years,
            $holder,
            $template
        );
    }

    public function toString(): string
    {
        return $this->template->toString([
            '<copyright-years>' => $this->years->toString(),
            '<copyright-holder>' => $this->holder->toString(),
        ]);
    }

    public function saveAs(string $filename): void
    {
        \file_put_contents(
            $filename,
            $this->toString()
        );
    }
}

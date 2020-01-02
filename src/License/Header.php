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
final class Header
{
    private $years;

    private $holder;

    private $notice;

    private $url;

    private function __construct(Copyright\Years $years, Copyright\Holder $holder, Notice $notice, Url $url)
    {
        $this->years = $years;
        $this->holder = $holder;
        $this->notice = $notice;
        $this->url = $url;
    }

    public static function create(Copyright\Years $years, Copyright\Holder $holder, Notice $notice, Url $url): self
    {
        return new self(
            $years,
            $holder,
            $notice,
            $url
        );
    }

    public function toString(): string
    {
        if ($this->notice->isEmpty()) {
            return <<<EOF
Copyright (c) {$this->years->toString()} {$this->holder->toString()}

@see {$this->url->toString()}
EOF;
        }

        return <<<EOF
Copyright (c) {$this->years->toString()} {$this->holder->toString()}

{$this->notice->toString()}

@see {$this->url->toString()}
EOF;
    }
}

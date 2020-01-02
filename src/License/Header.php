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
    private $copyrightYear;

    private $author;

    private $notice;

    private $url;

    private function __construct(CopyrightYears $copyrightYear, Author $author, Notice $notice, Url $url)
    {
        $this->copyrightYear = $copyrightYear;
        $this->author = $author;
        $this->notice = $notice;
        $this->url = $url;
    }

    public static function create(CopyrightYears $copyrightYear, Author $author, Notice $notice, Url $url): self
    {
        return new self(
            $copyrightYear,
            $author,
            $notice,
            $url
        );
    }

    public function toString(): string
    {
        if ($this->notice->isEmpty()) {
            return <<<EOF
Copyright (c) {$this->copyrightYear->toString()} {$this->author->toString()}

@see {$this->url->toString()}
EOF;
        }

        return <<<EOF
Copyright (c) {$this->copyrightYear->toString()} {$this->author->toString()}

{$this->notice->toString()}

@see {$this->url->toString()}
EOF;
    }
}

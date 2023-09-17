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

namespace Ergebnis\PhpCsFixer\Config\Test\Double\Config\RuleSet;

use Ergebnis\PhpCsFixer\Config\Fixers;
use Ergebnis\PhpCsFixer\Config\Name;
use Ergebnis\PhpCsFixer\Config\PhpVersion;
use Ergebnis\PhpCsFixer\Config\Rules;
use Ergebnis\PhpCsFixer\Config\RuleSet;

final class DummyRuleSet implements RuleSet
{
    public function __construct(
        private readonly Fixers $customFixers,
        private readonly Name $name,
        private readonly PhpVersion $phpVersion,
        private readonly Rules $rules,
    ) {
    }

    public function customFixers(): Fixers
    {
        return $this->customFixers;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function phpVersion(): PhpVersion
    {
        return $this->phpVersion;
    }

    public function rules(): Rules
    {
        return $this->rules;
    }

    public function withHeader(string $header): RuleSet
    {
        throw new \BadMethodCallException(\sprintf(
            'Method "%s" is not implemented yet.',
            __METHOD__,
        ));
    }
}

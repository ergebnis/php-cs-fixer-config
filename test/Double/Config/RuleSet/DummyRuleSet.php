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

use Ergebnis\PhpCsFixer\Config\Name;
use Ergebnis\PhpCsFixer\Config\PhpVersion;
use Ergebnis\PhpCsFixer\Config\RuleSet;

final class DummyRuleSet implements RuleSet
{
    public function __construct(
        private readonly iterable $customFixers,
        private readonly Name $name,
        private readonly array $rules,
        private readonly PhpVersion $phpVersion,
    ) {
    }

    public function customFixers(): iterable
    {
        return $this->customFixers;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function rules(): array
    {
        return $this->rules;
    }

    public function targetPhpVersion(): PhpVersion
    {
        return $this->phpVersion;
    }
}

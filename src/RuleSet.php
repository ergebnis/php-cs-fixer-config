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

interface RuleSet
{
    /**
     * @return iterable<Fixer\FixerInterface>
     */
    public function customFixers(): iterable;

    /**
     * Returns the name of the rule set.
     */
    public function name(): Name;

    /**
     * Returns the minimum required PHP version.
     */
    public function phpVersion(): PhpVersion;

    /**
     * Returns rules along with their configuration.
     */
    public function rules(): Rules;
}

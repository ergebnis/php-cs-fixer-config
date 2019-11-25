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

namespace Ergebnis\PhpCsFixer\Config;

interface RuleSet
{
    /**
     * Returns the name of the rule set.
     *
     * @return string
     */
    public function name();

    /**
     * Returns an array of rules along with their configuration.
     *
     * @return array
     */
    public function rules();

    /**
     * Returns the minimum required PHP version (PHP_VERSION_ID).
     *
     * @see http://php.net/manual/en/reserved.constants.php
     *
     * @return int
     */
    public function targetPhpVersion();
}

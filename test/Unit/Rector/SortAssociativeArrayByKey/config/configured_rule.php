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

use Ergebnis\PhpCsFixer;
use Rector\Config;

return static function (Config\RectorConfig $rectorConfig): void {
    $rectorConfig->rule(PhpCsFixer\Config\Test\Rector\SortAssociativeArrayByKey::class);
};

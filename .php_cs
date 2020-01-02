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

use Ergebnis\PhpCsFixer\Config;

$header = Config\License\Header::create(
    Config\License\Copyright\Years::fromYear(Config\License\Copyright\Year::fromString('2019')),
    Config\License\Copyright\Holder::fromString('Andreas Möller'),
    Config\License\Notice::fromString(
        <<<'EOF'
For the full copyright and license information, please view
the LICENSE file that was distributed with this source code.
EOF
    ),
    Config\License\Url::fromString('https://github.com/ergebnis/php-cs-fixer-config')
);

$config = Config\Factory::fromRuleSet(new Config\RuleSet\Php71($header->toString()));

$config->getFinder()
    ->ignoreDotFiles(false)
    ->in(__DIR__)
    ->exclude([
        '.build',
        '.dependabot',
        '.github',
    ])
    ->name('.php_cs');

$config->setCacheFile(__DIR__ . '/.build/php-cs-fixer/.php_cs.cache');

return $config;

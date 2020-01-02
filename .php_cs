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

$header = Config\Header\Header::create(
    Config\Header\CopyrightYears::fromYear(Config\Header\Year::fromString('2019')),
    Config\Header\Author::fromString('Andreas Möller'),
    Config\Header\License::fromString(
        <<<'EOF'
For the full copyright and license information, please view
the LICENSE file that was distributed with this source code.
EOF
    ),
    Config\Header\Url::fromString('https://github.com/ergebnis/php-cs-fixer-config')
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

<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019-2020 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

use Ergebnis\PhpCsFixer\Config;

$years = Config\License\Copyright\Years::fromRange(
    Config\License\Copyright\Year::fromString('2019'),
    Config\License\Copyright\Year::current()
);

$holder = Config\License\Copyright\Holder::fromString('Andreas Möller');

$file = Config\License\File::create(
    $years,
    $holder,
    Config\License\Template::fromString(
        <<<'EOF'
The MIT License (MIT)

Copyright (c) <copyright-years> <copyright-holder>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
documentation files (the "Software"), to deal in the Software without restriction, including without limitation the
rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit
persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the
Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE
WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR
OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

EOF
    )
);

$file->saveAs(__DIR__ . '/LICENSE');

$header = Config\License\Header::create(
    $years,
    $holder,
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

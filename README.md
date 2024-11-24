# php-cs-fixer-config

[![Integrate](https://github.com/ergebnis/php-cs-fixer-config/workflows/Integrate/badge.svg)](https://github.com/ergebnis/php-cs-fixer-config/actions)
[![Merge](https://github.com/ergebnis/php-cs-fixer-config/workflows/Merge/badge.svg)](https://github.com/ergebnis/php-cs-fixer-config/actions)
[![Release](https://github.com/ergebnis/php-cs-fixer-config/workflows/Release/badge.svg)](https://github.com/ergebnis/php-cs-fixer-config/actions)
[![Renew](https://github.com/ergebnis/php-cs-fixer-config/workflows/Renew/badge.svg)](https://github.com/ergebnis/php-cs-fixer-config/actions)

[![Code Coverage](https://codecov.io/gh/ergebnis/php-cs-fixer-config/branch/main/graph/badge.svg)](https://codecov.io/gh/ergebnis/php-cs-fixer-config)

[![Latest Stable Version](https://poser.pugx.org/ergebnis/php-cs-fixer-config/v/stable)](https://packagist.org/packages/ergebnis/php-cs-fixer-config)
[![Total Downloads](https://poser.pugx.org/ergebnis/php-cs-fixer-config/downloads)](https://packagist.org/packages/ergebnis/php-cs-fixer-config)
[![Monthly Downloads](http://poser.pugx.org/ergebnis/php-cs-fixer-config/d/monthly)](https://packagist.org/packages/ergebnis/php-cs-fixer-config)

This project provides a [`composer`](https://getcomposer.org) package with a configuration factory and rule set factories for [`friendsofphp/php-cs-fixer`](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer).

## Installation

Run

```sh
composer require --dev ergebnis/php-cs-fixer-config
```

## Usage

### Configuration

Pick one of the rule sets:

- [`Ergebnis\PhpCsFixer\RuleSet\Php53`](src/RuleSet/Php53.php)
- [`Ergebnis\PhpCsFixer\RuleSet\Php54`](src/RuleSet/Php54.php)
- [`Ergebnis\PhpCsFixer\RuleSet\Php55`](src/RuleSet/Php55.php)
- [`Ergebnis\PhpCsFixer\RuleSet\Php56`](src/RuleSet/Php56.php)
- [`Ergebnis\PhpCsFixer\RuleSet\Php70`](src/RuleSet/Php70.php)
- [`Ergebnis\PhpCsFixer\RuleSet\Php71`](src/RuleSet/Php71.php)
- [`Ergebnis\PhpCsFixer\RuleSet\Php72`](src/RuleSet/Php72.php)
- [`Ergebnis\PhpCsFixer\RuleSet\Php73`](src/RuleSet/Php73.php)
- [`Ergebnis\PhpCsFixer\RuleSet\Php74`](src/RuleSet/Php74.php)
- [`Ergebnis\PhpCsFixer\RuleSet\Php80`](src/RuleSet/Php80.php)
- [`Ergebnis\PhpCsFixer\RuleSet\Php81`](src/RuleSet/Php81.php)
- [`Ergebnis\PhpCsFixer\RuleSet\Php82`](src/RuleSet/Php82.php)
- [`Ergebnis\PhpCsFixer\RuleSet\Php83`](src/RuleSet/Php83.php)
- [`Ergebnis\PhpCsFixer\RuleSet\Php84`](src/RuleSet/Php84.php)

Create a configuration file `.php-cs-fixer.php` in the root of your project:

```php
<?php

declare(strict_types=1);

use Ergebnis\PhpCsFixer\Config;

$ruleSet = Config\RuleSet\Php83::create();

$config = Config\Factory::fromRuleSet($ruleSet);

$config->getFinder()->in(__DIR__);
$config->setCacheFile(__DIR__ . '/.build/php-cs-fixer/.php-cs-fixer.cache');

return $config;
```

### Git

All configuration examples use the caching feature, and if you want to use it as well, you should add the cache directory to `.gitignore`:

```diff
+ /.build/
 /vendor/
```

### Configuring a rule set with header

:bulb: Optionally specify a header:

```diff
 <?php

 declare(strict_types=1);

 use Ergebnis\PhpCsFixer\Config;

+$header = <<<EOF
+Copyright (c) 2023 Andreas Möller
+
+For the full copyright and license information, please view
+the LICENSE file that was distributed with this source code.
+
+@see https://github.com/ergebnis/php-cs-fixer-config
+EOF;

-$ruleSet = Config\RuleSet\Php83::create();
+$ruleSet = Config\RuleSet\Php83::create()->withHeader($header);

 $config = Config\Factory::fromRuleSet($ruleSet);

 $config->getFinder()->in(__DIR__);
 $config->setCacheFile(__DIR__ . '/.build/php-cs-fixer/.php-cs-fixer.cache');

 return $config;
```

This will enable and configure the [`HeaderCommentFixer`](https://github.com/FriendsOfPHP/PHP-CS-Fixer/blob/v2.1.1/src/Fixer/Comment/HeaderCommentFixer.php), so that file headers will be added to PHP files, for example:

```diff
 <?php

 declare(strict_types=1);

+/**
+ * Copyright (c) 2023 Andreas Möller
+ *
+ * For the full copyright and license information, please view
+ * the LICENSE file that was distributed with this source code.
+ *
+ * @see https://github.com/ergebnis/php-cs-fixer-config
+ */
```

### Configuring a rule set that overrides rules

:bulb: Optionally override rules from a rule set by passing a set of rules to be merged in:

```diff
 <?php

 declare(strict_types=1);

 use Ergebnis\PhpCsFixer\Config;

-$ruleSet = Config\RuleSet\Php83::create();
+$ruleSet = Config\RuleSet\Php83::create()->withRules(Config\Rules::fromArray([
+    'mb_str_functions' => false,
+    'strict_comparison' => false,
+]));

 $config = Config\Factory::fromRuleSet($ruleSet);

 $config->getFinder()->in(__DIR__);
 $config->setCacheFile(__DIR__ . '/.build/php-cs-fixer/.php-cs-fixer.cache');

 return $config;
```

### Configuring a rule set that registers and configures rules for custom fixers

:bulb: Optionally register and configure rules for custom fixers:

```diff
 <?php

 declare(strict_types=1);

 use Ergebnis\PhpCsFixer\Config;
 use FooBar\Fixer;

-$ruleSet = Config\RuleSet\Php83::create();
+$ruleSet = Config\RuleSet\Php83::create()
+    ->withCustomFixers(Config\Fixers::fromFixers(
+        new Fixer\BarBazFixer(),
+        new Fixer\QuzFixer(),
+    ))
+    ->withRules(Config\Rules::fromArray([
+        'FooBar/bar_baz' => true,
+        'FooBar/quz' => [
+            'qux => false,
+        ],
+    ]))
+]);

 $config = Config\Factory::fromRuleSet($ruleSet);

 $config->getFinder()->in(__DIR__);
 $config->setCacheFile(__DIR__ . '/.build/php-cs-fixer/.php-cs-fixer.cache');

 return $config;
```

### Makefile

If you like [`Makefile`](https://www.gnu.org/software/make/manual/make.html#Introduction)s, create a `Makefile` with a `coding-standards` target:

```diff
+.PHONY: coding-standards
+coding-standards: vendor
+    mkdir -p .build/php-cs-fixer
+    vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.php --diff --show-progress=dots --verbose

 vendor: composer.json composer.lock
     composer validate
     composer install
```

Run

```sh
make coding-standards
```

to automatically fix coding standard violations.

### Composer script

If you like [`composer` scripts](https://getcomposer.org/doc/articles/scripts.md), add a `coding-standards` script to `composer.json`:

```diff
 {
   "name": "foo/bar",
   "require": {
     "php": "^8.1",
   },
   "require-dev": {
     "ergebnis/php-cs-fixer-config": "^6.21.0"
+  },
+  "scripts": {
+    "coding-standards": [
+      "mkdir -p .build/php-cs-fixer",
+      "php-cs-fixer fix --diff --show-progress=dots --verbose"
+    ]
   }
 }
```

Run

```sh
composer coding-standards
```

to automatically fix coding standard violations.

### GitHub Actions

If you like [GitHub Actions](https://github.com/features/actions), add a `coding-standards` job to your workflow:

```diff
 on:
   pull_request: null
   push:
     branches:
       - main

 name: "Integrate"

 jobs:
+  coding-standards:
+    name: "Coding Standards"
+
+    runs-on: ubuntu-latest
+
+    strategy:
+      matrix:
+        php-version:
+          - "8.1"
+
+    steps:
+      - name: "Checkout"
+        uses: "actions/checkout@v2"
+
+      - name: "Set up PHP"
+        uses: "shivammathur/setup-php@v2"
+        with:
+          coverage: "none"
+          php-version: "${{ matrix.php-version }}"
+
+      - name: "Cache dependencies installed with composer"
+        uses: "actions/cache@v2"
+        with:
+          path: "~/.composer/cache"
+          key: "php-${{ matrix.php-version }}-composer-${{ hashFiles('composer.lock') }}"
+          restore-keys: "php-${{ matrix.php-version }}-composer-"
+
+      - name: "Install locked dependencies with composer"
+        run: "composer install --ansi --no-interaction --no-progress --no-suggest"
+
+      - name: "Create cache directory for friendsofphp/php-cs-fixer"
+        run: mkdir -p .build/php-cs-fixer
+
+      - name: "Cache cache directory for friendsofphp/php-cs-fixer"
+        uses: "actions/cache@v2"
+        with:
+          path: "~/.build/php-cs-fixer"
+          key: "php-${{ matrix.php-version }}-php-cs-fixer-${{ github.ref_name }}"
+          restore-keys: |
+            php-${{ matrix.php-version }}-php-cs-fixer-main
+            php-${{ matrix.php-version }}-php-cs-fixer-
+
+      - name: "Run friendsofphp/php-cs-fixer"
+        run: "vendor/bin/php-cs-fixer fix --ansi --config=.php-cs-fixer.php --diff --dry-run --show-progress=dots --verbose"
```

## Changelog

The maintainers of this project record notable changes to this project in a [changelog](CHANGELOG.md).

## Contributing

The maintainers of this project suggest following the [contribution guide](.github/CONTRIBUTING.md).

## Code of Conduct

The maintainers of this project ask contributors to follow the [code of conduct](https://github.com/ergebnis/.github/blob/main/CODE_OF_CONDUCT.md).

## General Support Policy

The maintainers of this project provide limited support.

You can support the maintenance of this project by [sponsoring @localheinz](https://github.com/sponsors/localheinz) or [requesting an invoice for services related to this project](mailto:am@localheinz.com?subject=ergebnis/php-cs-fixer-config:%20Requesting%20invoice%20for%20services).

## PHP Version Support Policy

This project supports PHP versions with [active and security support](https://www.php.net/supported-versions.php).

The maintainers of this project add support for a PHP version following its initial release and drop support for a PHP version when it has reached the end of security support.

## Security Policy

This project has a [security policy](.github/SECURITY.md).

## License

This project uses the [MIT license](LICENSE.md).

## Credits

This project is inspired by and also replaces [`localheinz/php-cs-fixer-config`](https://github.com/localheinz/php-cs-fixer-config).

This project requires and enables custom fixers from the following packages:

- [`erickskrauch/php-cs-fixer-custom-fixers`](https://github.com/erickskrauch/php-cs-fixer-custom-fixers)
- [`kubawerlos/php-cs-fixer-custom-fixers`](https://github.com/kubawerlos/php-cs-fixer-custom-fixers)

## Social

Follow [@localheinz](https://twitter.com/intent/follow?screen_name=localheinz) and [@ergebnis](https://twitter.com/intent/follow?screen_name=ergebnis) on Twitter.

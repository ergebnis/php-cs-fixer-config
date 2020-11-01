# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

For a full diff see [`2.5.2...main`][2.5.2...main].

## [`2.5.2`][2.5.2]

For a full diff see [`2.5.1...2.5.2`][2.5.1...2.5.2].

### Fixed

* Enabled and configured proxied instead of deprecated fixers ([#241]), by [@dependabot]

## [`2.5.1`][2.5.1]

For a full diff see [`2.5.0...2.5.1`][2.5.0...2.5.1].

### Fixed

* Updated `friendsofphp/php-cs-fixer` ([#226]), by [@dependabot]

## [`2.5.0`][2.5.0]

For a full diff see [`2.4.0...2.5.0`][2.4.0...2.5.0].

### Changed

* Configured the `phpdoc_add_missing_param_annotation` fixer to add annotation for untyped parameters only ([#220]), by [@localheinz]

## [`2.4.0`][2.4.0]

For a full diff see [`2.3.0...2.4.0`][2.3.0...2.4.0].

### Changed

* Enabled `no_superfluous_phpdoc_tags` fixer ([#215]), by [@localheinz]

## [`2.3.0`][2.3.0]

For a full diff see [`2.2.2...2.3.0`][2.2.2...2.3.0].

### Added

* Added `RuleSet\Php74` for use with PHP 7.4 ([#200]), by [@dependabot]

## [`2.2.2`][2.2.2]

For a full diff see [`2.2.1...2.2.2`][2.2.1...2.2.2].

### Changed

* Dropped support for PHP 7.1 ([#168]), by [@dependabot]

## [`2.2.1`][2.2.1]

For a full diff see [`2.2.0...2.2.1`][2.2.0...2.2.1].

### Fixed

* Updated `friendsofphp/php-cs-fixer` ([#135]), by [@dependabot]

## [`2.2.0`][2.2.0]

For a full diff see [`2.1.2...2.2.0`][2.1.2...2.2.0].

### Changed

* Configured `ordered_imports` fixer to group imports by kind ([#133]), by [@localheinz]

## [`2.1.0`][2.1.0]

For a full diff see [`2.0.0...2.1.0`][2.0.0...2.1.0].

### Changed

* Configured `php_unit_dedicate_assert` fixer to target `newest` versions of `phpunit/phpunit` ([#73]), by [@localheinz]

## [`2.0.0`][2.0.0]

For a full diff see [`1.1.3...2.0.0`][1.1.3...2.0.0].

### Removed

* Removed classes uses for construction of header, use [`ergebnis/license`](https://github.com/ergebnis/license) instead ([#50]), by [@localheinz]

## [`1.1.3`][1.1.3]

For a full diff see [`1.1.2...1.1.3`][1.1.2...1.1.3].

### Added

* Allowed construction of header ([#23]), by [@localheinz]

## [`1.1.2`][1.1.2]

For a full diff see [`1.1.1...1.1.2`][1.1.1...1.1.2].

### Fixed

* Brought back support for PHP 7.1 ([#17]), by [@localheinz]

## [`1.1.1`][1.1.1]

For a full diff see [`1.1.0...1.1.1`][1.1.0...1.1.1].

### Fixed

* Removed an inappropriate `replace` configuration from `composer.json` ([#14]), by [@localheinz]

## [`1.1.0`][1.1.0]

For a full diff see [`1.0.0...1.1.0`][1.0.0...1.1.0].

### Added

* Added `Ergebnis\PhpCsFixer\Config\RuleSet\Laravel6`, a rule set for Laravel 6 ([#3]), by [@linuxjuggler]

## [`1.0.0`][1.0.0]

For a full diff see [`d899e77...1.0.0`][d899e77...1.0.0].

[1.0.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/1.0.0
[1.1.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/1.1.0
[1.1.1]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/1.1.1
[1.1.2]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/1.1.2
[1.1.3]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/1.1.3
[2.0.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.0.0
[2.1.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.1.0
[2.2.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.2.0
[2.2.1]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.2.1
[2.2.2]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.2.2
[2.3.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.3.0
[2.4.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.4.0
[2.5.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.5.0
[2.5.1]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.5.1
[2.5.2]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.5.2

[d899e77...1.0.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/d899e77...1.0.0
[1.0.0...1.1.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/1.0.0...1.1.0
[1.1.0...1.1.1]: https://github.com/ergebnis/php-cs-fixer-config/compare/1.1.0...1.1.1
[1.1.1...1.1.2]: https://github.com/ergebnis/php-cs-fixer-config/compare/1.1.1...1.1.2
[1.1.2...1.1.3]: https://github.com/ergebnis/php-cs-fixer-config/compare/1.1.2...1.1.3
[1.1.3...2.0.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/1.1.3...2.0.0
[2.0.0...2.1.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.0.0...2.1.0
[2.1.2...2.2.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.1.2...2.2.0
[2.2.0...2.2.1]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.2.0...2.2.1
[2.2.1...2.2.2]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.2.1...2.2.2
[2.2.2...2.3.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.2.1...2.3.0
[2.3.0...2.4.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.3.0...2.4.0
[2.4.0...2.5.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.4.0...2.5.0
[2.5.0...2.5.1]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.5.0...2.5.1
[2.5.1...2.5.2]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.5.1...2.5.2
[2.5.2...main]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.5.2...main

[#3]: https://github.com/ergebnis/php-cs-fixer-config/pull/3
[#14]: https://github.com/ergebnis/php-cs-fixer-config/pull/14
[#17]: https://github.com/ergebnis/php-cs-fixer-config/pull/17
[#23]: https://github.com/ergebnis/php-cs-fixer-config/pull/23
[#50]: https://github.com/ergebnis/php-cs-fixer-config/pull/50
[#73]: https://github.com/ergebnis/php-cs-fixer-config/pull/73
[#133]: https://github.com/ergebnis/php-cs-fixer-config/pull/133
[#135]: https://github.com/ergebnis/php-cs-fixer-config/pull/135
[#168]: https://github.com/ergebnis/php-cs-fixer-config/pull/168
[#200]: https://github.com/ergebnis/php-cs-fixer-config/pull/200
[#215]: https://github.com/ergebnis/php-cs-fixer-config/pull/215
[#220]: https://github.com/ergebnis/php-cs-fixer-config/pull/220
[#226]: https://github.com/ergebnis/php-cs-fixer-config/pull/226
[#241]: https://github.com/ergebnis/php-cs-fixer-config/pull/241

[@dependabot]: https://github.com/apps/dependabot
[@linuxjuggler]: https://github.com/linuxjuggler
[@localheinz]: https://github.com/localheinz

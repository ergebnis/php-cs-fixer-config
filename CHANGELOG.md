# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

For a full diff see [`2.0.0...master`][2.0.0...master].

## [`2.0.0`][2.0.0]

For a full diff see [`1.1.2...2.0.0`][1.1.2...2.0.0].

### Removed

* Removed classes uses for construction of header, use [`ergebnis/license`](https://github.com/ergebnis/license) instead ([#50]), by [@localheinz]

## [`1.1.2`][1.1.2]

For a full diff see [`1.1.1...1.1.2`][1.1.1...1.1.2].

### Added

* Allowed construction of header ([#23]), by [@localheinz]

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
[2.0.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.0.0

[d899e77...1.0.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/d899e77...1.0.0
[1.0.0...1.1.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/1.0.0...1.1.0
[1.1.0...1.1.1]: https://github.com/ergebnis/php-cs-fixer-config/compare/1.1.0...1.1.1
[1.1.1...1.1.2]: https://github.com/ergebnis/php-cs-fixer-config/compare/1.1.1...1.1.2
[1.1.2...2.0.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/1.1.2...2.0.0
[2.0.0...master]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.0.0...master

[#3]: https://github.com/ergebnis/php-cs-fixer-config/pull/3
[#14]: https://github.com/ergebnis/php-cs-fixer-config/pull/14
[#17]: https://github.com/ergebnis/php-cs-fixer-config/pull/17
[#23]: https://github.com/ergebnis/php-cs-fixer-config/pull/23
[#50]: https://github.com/ergebnis/php-cs-fixer-config/pull/50

[@linuxjuggler]: https://github.com/linuxjuggler
[@localheinz]: https://github.com/localheinz

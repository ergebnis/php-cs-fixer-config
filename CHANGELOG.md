# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

For a full diff see [`2.13.1...main`][2.13.1...main].

### Changed

* Updated `friendsofphp/php-cs-fixer` ([#400]), by [@dependabot]
* Configured `trailing_comma_in_multiline` fixer to add trailing commas for arguments in `Php73`, `Php74`, and `Php80` rule sets ([#401]), by [@localheinz]
* Configured `trailing_comma_in_multiline` fixer to add trailing commas for parameters in `Php80` rule set ([#404]), by [@localheinz]

## [`2.13.1`][2.13.1]

For a full diff see [`2.13.0...2.13.1`][2.13.0...2.13.1].

### Fixed

* Stopped using deprecated configuration for `class_attributes_separation` fixer ([#354]), by [@localheinz]
* Updated `friendsofphp/php-cs-fixer` ([#392]), by [@dependabot]

## [`2.13.0`][2.13.0]

For a full diff see [`2.12.1...2.13.0`][2.12.1...2.13.0].

### Added

* Added `Ergebnis\PhpCsFixer\Config\RuleSet\Php80`, a rule set for PHP 8.0 ([#350]), by [@localheinz]
* Added `Ergebnis\PhpCsFixer\Config\RuleSet\Php72`, a rule set for PHP 7.2 ([#352]), by [@localheinz]

## [`2.12.1`][2.12.1]

For a full diff see [`2.12.0...2.12.1`][2.12.0...2.12.1].

### Fixed

* Updated `friendsofphp/php-cs-fixer` ([#348]), by [@dependabot]

## [`2.12.0`][2.12.0]

For a full diff see [`2.11.0...2.12.0`][2.11.0...2.12.0].

### Changed

* Configured `phpdoc_order_by_value` fixer to sort `@method`, `@property`, `@property-read`, and `@property-write` annotations in the `Php71`, `Php73`, `Php74` rule sets ([#344]), by [@localheinz]

### Fixed

* Updated `friendsofphp/php-cs-fixer` ([#343]), by [@dependabot]

## [`2.11.0`][2.11.0]

For a full diff see [`2.10.0...2.11.0`][2.10.0...2.11.0].

### Added

* Added `Ergebnis\PhpCsFixer\Config\RuleSet\Faker`, a rule set for `fakerphp/faker` ([#323]), by [@localheinz]

### Changed

* Updated `friendsofphp/php-cs-fixer` ([#337]), by [@dependabot]

## [`2.10.0`][2.10.0]

For a full diff see [`2.9.0...2.10.0`][2.9.0...2.10.0].

### Added

* Added `Config\RuleSet\ExplicitRuleSet` marker interface for rule-sets that should  be configured explicitly ([#311]), by [@localheinz]

### Changed

* Required only implementations of `Config\RuleSet\ExplicitRuleSet` not to configure any rules for rule sets ([#313]), by [@localheinz]
* Required implementations of `Config\RuleSet\ExplicitRuleSet` to configure non-deprecated rules that are configurable with an explicit configuration when enabled ([#314]), by [@localheinz]
* Required implementations of `Config\RuleSet\ExplicitRuleSet` to configure non-deprecated rules that are configurable with all non-deprecated configuration options when enabled ([#320]), by [@localheinz]
* Required only implementations of `Config\RuleSet\ExplicitRuleSet` to configure all non-deprecated rules ([#321]), by [@localheinz]

### Fixed

* Stopped configuring rules using deprecated configuration options ([#319]), by [@localheinz]

## [`2.9.0`][2.9.0]

For a full diff see [`2.8.0...2.9.0`][2.8.0...2.9.0].

### Changed

* Enabled and configured `php_unit_test_case_static_method_calls` fixer for `Ergebnis\PhpCsFixer\Config\RuleSet\PhpUnit` ([#301]), by [@localheinz]
* Configured `phpdoc_order_by_value` fixer to order `@throws` annotations ([#302]), by [@localheinz]
* Enabled `php_unit_set_up_tear_down_visibility` fixer for `Ergebnis\PhpCsFixer\Config\RuleSet\PhpUnit` ([#303]), by [@localheinz]
* Enabled `allow_single_line_anonymous_class_with_empty_body` option for `braces` fixer ([#306]), by [@localheinz]
* Configured `phpdoc_order_by_value` fixer to order `@throws` annotations for `Ergebnis\PhpCsFixer\Config\RuleSet\PhpUnit` ([#310]), by [@localheinz]

### Fixed

* Updated `friendsofphp/php-cs-fixer` ([#304]), by [@dependabot]
* Updated `friendsofphp/php-cs-fixer` ([#309]), by [@dependabot]

## [`2.8.0`][2.8.0]

For a full diff see [`2.7.0...2.8.0`][2.7.0...2.8.0].

### Added

* Added `Ergebnis\PhpCsFixer\Config\RuleSet\PhpUnit`, a rule set for `phpunit/phpunit` ([#300]), by [@localheinz]

## [`2.7.0`][2.7.0]

For a full diff see [`2.6.1...2.7.0`][2.6.1...2.7.0].

### Changed

* Enabled `array_push` fixer ([#279]), by [@localheinz]
* Enabled `clean_namespace` fixer ([#280]), by [@localheinz]
* Enabled `lambda_not_used_import` fixer ([#281]), by [@localheinz]
* Enabled `no_alias_language_construct_call` fixer ([#282]), by [@localheinz]
* Enabled `no_trailing_whitespace_in_string` fixer ([#283]), by [@localheinz]
* Enabled `no_useless_sprintf` fixer ([#284]), by [@localheinz]
* Enabled and configured `operator_linebreak` fixer ([#285]), by [@localheinz]
* Enabled and configured `phpdoc_inline_tag_normalizer` fixer ([#286]), by [@localheinz]
* Enabled and configured `phpdoc_tag_casing` fixer ([#287]), by [@localheinz]
* Enabled `regular_callable_call` fixer ([#288]), by [@localheinz]
* Enabled and configured `single_space_after_construct` fixer ([#289]), by [@localheinz]
* Enabled `switch_continue_to_break` fixer ([#290]), by [@localheinz]
* Enabled `ternary_to_elvis_operator` fixer ([#291]), by [@localheinz]

## [`2.6.1`][2.6.1]

For a full diff see [`2.6.0...2.6.1`][2.6.0...2.6.1].

### Fixed

* Updated `friendsofphp/php-cs-fixer` ([#276]), by [@localheinz]

## [`2.6.0`][2.6.0]

For a full diff see [`2.5.3...2.6.0`][2.5.3...2.6.0].

### Changed

* Updated `friendsofphp/php-cs-fixer` ([#255]), by [@localheinz]
* Configured `phpdoc_order_by_value` fixer to order `@dataProvider` annotations by value ([#257]), by [@localheinz]
* Configured `phpdoc_order_by_value` fixer to order `@uses` annotations by value ([#258]), by [@localheinz]
* Configured `phpdoc_order_by_value` fixer to order `@author` annotations by value ([#259]), by [@localheinz]
* Configured `phpdoc_order_by_value` fixer to order `@coversNothing` annotations by value ([#260]), by [@localheinz]
* Configured `phpdoc_order_by_value` fixer to order `@depends` annotations by value ([#261]), by [@localheinz]
* Configured `phpdoc_order_by_value` fixer to order `@group` annotations by value ([#262]), by [@localheinz]
* Configured `phpdoc_order_by_value` fixer to order `@internal` annotations by value ([#263]), by [@localheinz]
* Configured `phpdoc_order_by_value` fixer to order `@requires` annotations by value ([#264]), by [@localheinz]
* Allowed installation on PHP 8.0 ([#265]), by [@Nyholm]

## [`2.5.3`][2.5.3]

For a full diff see [`2.5.2...2.5.3`][2.5.2...2.5.3].

### Fixed

* Disabled `heredoc_indentaton` fixer ([#247]), by [@localheinz]

## [`2.5.2`][2.5.2]

For a full diff see [`2.5.1...2.5.2`][2.5.1...2.5.2].

### Fixed

* Enabled and configured proxied instead of deprecated fixers ([#241]), by [@localheinz]

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

* Added `RuleSet\Php74` for use with PHP 7.4 ([#200]), by [@localheinz]

## [`2.2.2`][2.2.2]

For a full diff see [`2.2.1...2.2.2`][2.2.1...2.2.2].

### Changed

* Dropped support for PHP 7.1 ([#168]), by [@localheinz]

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
[2.5.3]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.5.3
[2.6.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.6.0
[2.6.1]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.6.1
[2.7.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.7.0
[2.8.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.8.0
[2.9.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.9.0
[2.10.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.10.0
[2.11.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.11.0
[2.12.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.12.0
[2.12.1]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.12.1
[2.13.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.13.0
[2.13.1]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.13.1

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
[2.5.2...2.5.3]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.5.2...2.5.3
[2.5.3...2.6.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.5.3...2.6.0
[2.6.0...2.6.1]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.6.0...2.6.1
[2.6.1...2.7.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.6.1...2.7.0
[2.7.0...2.8.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.7.0...2.8.0
[2.8.0...2.9.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.8.0...2.9.0
[2.9.0...2.10.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.9.0...2.10.0
[2.10.0...2.11.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.10.0...2.11.0
[2.11.0...2.12.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.11.0...2.12.0
[2.12.0...2.12.1]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.12.0...2.12.1
[2.12.1...2.13.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.12.1...2.13.0
[2.13.0...2.13.1]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.13.0...2.13.1
[2.13.1...main]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.13.0...main

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
[#247]: https://github.com/ergebnis/php-cs-fixer-config/pull/247
[#255]: https://github.com/ergebnis/php-cs-fixer-config/pull/255
[#257]: https://github.com/ergebnis/php-cs-fixer-config/pull/257
[#258]: https://github.com/ergebnis/php-cs-fixer-config/pull/258
[#259]: https://github.com/ergebnis/php-cs-fixer-config/pull/259
[#260]: https://github.com/ergebnis/php-cs-fixer-config/pull/260
[#261]: https://github.com/ergebnis/php-cs-fixer-config/pull/261
[#262]: https://github.com/ergebnis/php-cs-fixer-config/pull/262
[#263]: https://github.com/ergebnis/php-cs-fixer-config/pull/263
[#264]: https://github.com/ergebnis/php-cs-fixer-config/pull/264
[#265]: https://github.com/ergebnis/php-cs-fixer-config/pull/265
[#276]: https://github.com/ergebnis/php-cs-fixer-config/pull/276
[#279]: https://github.com/ergebnis/php-cs-fixer-config/pull/279
[#280]: https://github.com/ergebnis/php-cs-fixer-config/pull/280
[#281]: https://github.com/ergebnis/php-cs-fixer-config/pull/281
[#282]: https://github.com/ergebnis/php-cs-fixer-config/pull/282
[#283]: https://github.com/ergebnis/php-cs-fixer-config/pull/283
[#284]: https://github.com/ergebnis/php-cs-fixer-config/pull/284
[#285]: https://github.com/ergebnis/php-cs-fixer-config/pull/285
[#286]: https://github.com/ergebnis/php-cs-fixer-config/pull/286
[#287]: https://github.com/ergebnis/php-cs-fixer-config/pull/287
[#288]: https://github.com/ergebnis/php-cs-fixer-config/pull/288
[#289]: https://github.com/ergebnis/php-cs-fixer-config/pull/289
[#290]: https://github.com/ergebnis/php-cs-fixer-config/pull/290
[#291]: https://github.com/ergebnis/php-cs-fixer-config/pull/291
[#300]: https://github.com/ergebnis/php-cs-fixer-config/pull/300
[#301]: https://github.com/ergebnis/php-cs-fixer-config/pull/301
[#302]: https://github.com/ergebnis/php-cs-fixer-config/pull/302
[#303]: https://github.com/ergebnis/php-cs-fixer-config/pull/303
[#304]: https://github.com/ergebnis/php-cs-fixer-config/pull/304
[#306]: https://github.com/ergebnis/php-cs-fixer-config/pull/306
[#309]: https://github.com/ergebnis/php-cs-fixer-config/pull/309
[#310]: https://github.com/ergebnis/php-cs-fixer-config/pull/310
[#311]: https://github.com/ergebnis/php-cs-fixer-config/pull/311
[#313]: https://github.com/ergebnis/php-cs-fixer-config/pull/313
[#314]: https://github.com/ergebnis/php-cs-fixer-config/pull/314
[#319]: https://github.com/ergebnis/php-cs-fixer-config/pull/319
[#320]: https://github.com/ergebnis/php-cs-fixer-config/pull/320
[#321]: https://github.com/ergebnis/php-cs-fixer-config/pull/321
[#323]: https://github.com/ergebnis/php-cs-fixer-config/pull/323
[#337]: https://github.com/ergebnis/php-cs-fixer-config/pull/337
[#343]: https://github.com/ergebnis/php-cs-fixer-config/pull/343
[#344]: https://github.com/ergebnis/php-cs-fixer-config/pull/344
[#348]: https://github.com/ergebnis/php-cs-fixer-config/pull/348
[#350]: https://github.com/ergebnis/php-cs-fixer-config/pull/350
[#352]: https://github.com/ergebnis/php-cs-fixer-config/pull/352
[#354]: https://github.com/ergebnis/php-cs-fixer-config/pull/354
[#392]: https://github.com/ergebnis/php-cs-fixer-config/pull/392
[#400]: https://github.com/ergebnis/php-cs-fixer-config/pull/400
[#401]: https://github.com/ergebnis/php-cs-fixer-config/pull/401
[#404]: https://github.com/ergebnis/php-cs-fixer-config/pull/404

[@dependabot]: https://github.com/apps/dependabot
[@linuxjuggler]: https://github.com/linuxjuggler
[@localheinz]: https://github.com/localheinz
[@Nyholm]: https://github.com/Nyholm

# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

For a full diff see [`5.0.0...main`][5.0.0...main].

### Fixed

- Updated `friendsofphp/php-cs-fixer` ([#684]), by [@dependabot]

## [`5.0.0`][5.0.0]

For a full diff see [`4.11.0...5.0.0`][4.11.0...5.0.0].

### Changed

- Dropped support for PHP 7.4 ([#672]), by [@localheinz]

### Removed

- Removed `Php74` rule set ([#673]), by [@localheinz]

## [`4.11.0`][4.11.0]

For a full diff see [`4.10.0...4.11.0`][4.10.0...4.11.0].

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#667]), by [@dependabot]

## [`4.10.0`][4.10.0]

For a full diff see [`4.9.0...4.10.0`][4.9.0...4.10.0].

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#661]), by [@dependabot]
- Enabled and configured `no_useless_concat_operator` fixer ([#662]), by [@localheinz]

## [`4.9.0`][4.9.0]

For a full diff see [`4.8.0...4.9.0`][4.8.0...4.9.0].

### Changed

- Configured `no_trailing_comma_in_singleline` fixer to include `group_import`  ([#655]), by [@dependabot]

## [`4.8.0`][4.8.0]

For a full diff see [`4.7.0...4.8.0`][4.7.0...4.8.0].

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#651]), by [@dependabot]

## [`4.7.0`][4.7.0]

For a full diff see [`4.6.0...4.7.0`][4.6.0...4.7.0].

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#642]), by [@dependabot]
- Configured the `whitespace_after_comma_in_array` fixer to ensure a single space using the `ensure_single_space` option ([#645]), by [@localheinz]
- Configured the `no_alternative_syntax` fixer to ensure a single space using the `fix_non_monolithic_code` option ([#646]), by [@localheinz]

### Fixed

- Require all configurable rules to be explicitly configured when enabled and part of an `ExplicitRuleSet` ([#644]), by [@localheinz]

## [`4.6.0`][4.6.0]

For a full diff see [`4.5.3...4.6.0`][4.5.3...4.6.0].

### Changed

- Enabled `no_multiple_statements_per_line` fixer ([#637]), by [@localheinz]

### Fixed

- Updated `friendsofphp/php-cs-fixer` ([#636]), by [@dependabot]

## [`4.5.3`][4.5.3]

For a full diff see [`4.5.2...4.5.3`][4.5.2...4.5.3].

### Fixed

- Updated `friendsofphp/php-cs-fixer` ([#633]), by [@dependabot]

## [`4.5.2`][4.5.2]

For a full diff see [`4.5.1...4.5.2`][4.5.1...4.5.2].

### Fixed

- Updated `friendsofphp/php-cs-fixer` ([#632]), by [@dependabot]

## [`4.5.1`][4.5.1]

For a full diff see [`4.5.0...4.5.1`][4.5.0...4.5.1].

### Fixed

- Updated `friendsofphp/php-cs-fixer` ([#630]), by [@dependabot]

## [`4.5.0`][4.5.0]

For a full diff see [`4.4.0...4.5.0`][4.4.0...4.5.0].

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#620]), by [@dependabot]
- Enabled `control_structure_braces` fixer ([#621]), by [@localheinz]
- Enabled and configured `curly_braces_position` fixer ([#622]), by [@localheinz]
- Enabled `no_useless_nullsafe_operator` fixer ([#623]), by [@localheinz]
- Enabled `statement_indentation` fixer ([#624]), by [@localheinz]
- Configured `no_unneeded_control_parentheses` fixer to include `negative_instanceof` and `others` in the `statements` option ([#625]), by [@localheinz]
- Configured `trailing_comma_in_multiline` fixer to include `match` in the `elements` option ([#626]), by [@localheinz]
- Configured `single_space_after_construct` fixer to include `type_colon` in the `constructs` option ([#627]), by [@localheinz]
- Configured `phpdoc_order_by_value` fixer to include `mixin` in the `annotations` option ([#628]), by [@localheinz]
- Configured `no_extra_blank_lines` fixer to include `attribute` in the `tokens` option ([#629]), by [@localheinz]

## [`4.4.0`][4.4.0]

For a full diff see [`4.3.0...4.4.0`][4.3.0...4.4.0].

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#591]), by [@dependabot]
- Enabled `date_time_create_from_format_call` fixer ([#592]), by [@localheinz]
- Configured `types_spaces` fixer to enforce no spaces between exception types when catching multiple exceptions with one `catch` statement ([#593]), by [@localheinz]

## [`4.3.0`][4.3.0]

For a full diff see [`4.2.0...4.3.0`][4.2.0...4.3.0].

### Changed

- Configured `blank_line_before_statement` fixer to include additional statements ([#581]), by [@localheinz]
- Configured `no_unneeded_control_parentheses` fixer to include additional statements ([#583]), by [@localheinz]
- Configured `ordered_class_elements` fixer to order more elements ([#584]), by [@localheinz]
- Configured `phpdoc_align` fixer to align more tags ([#586]), by [@localheinz]
- Configured `single_class_element_per_statement` fixer to enforce single class element for `const` statements ([#587]), by [@localheinz]
- Configured `single_space_after_construct` fixer to enforce a single space after additional constructs ([#588]), by [@localheinz]

## [`4.2.0`][4.2.0]

For a full diff see [`4.1.0...4.2.0`][4.1.0...4.2.0].

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#578]), by [@dependabot]
- Enabled `no_trailing_comma_in_singleline_function_call` fixer ([#579]), by [@localheinz]
- Enabled `single_line_comment_spacing` fixer ([#580]), by [@localheinz]

## [`4.1.0`][4.1.0]

For a full diff see [`4.0.0...4.1.0`][4.0.0...4.1.0].

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#565]), by [@dependabot]
- Enabled `class_reference_name_casing` fixer ([#566]), by [@localheinz]
- Enabled `no_unneeded_import_alias` fixer ([#567]), by [@localheinz]

## [`4.0.0`][4.0.0]

For a full diff see [`3.4.0...4.0.0`][3.4.0...4.0.0].

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#545]), by [@dependabot]
- Enabled `get_class_to_class_keyword` fixer ([#553]), by [@localheinz]

### Fixed

- Dropped support for PHP 7.3 ([#540]), by [@localheinz]

### Removed

- Removed `Php73` rule set ([#544]), by [@localheinz]

## [`3.4.0`][3.4.0]

For a full diff see [`3.3.0...3.4.0`][3.3.0...3.4.0].

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#527]), by [@dependabot]

## [`3.3.0`][3.3.0]

For a full diff see [`3.2.0...3.3.0`][3.2.0...3.3.0].

### Added

- Added `Php80` rule set  ([#521]), by [@dependabot]

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#510]), by [@dependabot]
- Updated `friendsofphp/php-cs-fixer` ([#513]), by [@dependabot]

## [`3.2.0`][3.2.0]

For a full diff see [`3.1.0...3.2.0`][3.1.0...3.2.0].

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#495]), by [@dependabot]
- Enabled `assign_null_coalescing_to_coalesce_equal` fixer in `Php74` and `Php80` rule sets ([#497]), by [@localheinz]
- Enabled and configured `control_structure_continuation_position` fixer ([#498]), by [@localheinz]
- Enabled and configured `empty_loop_condition` fixer ([#499]), by [@localheinz]
- Enabled `integer_literal_case` fixer ([#500]), by [@localheinz]
- Enabled `modernize_strpos` fixer for `Php80` rule set ([#501]), by [@localheinz]
- Enabled `no_space_around_double_colon` fixer ([#502]), by [@localheinz]
- Enabled `string_length_to_empty` fixer ([#503]), by [@localheinz]

### Fixed

- Stopped using deprecated `use_trait` option for `no_extra_blank_lines` fixer ([#496]), by [@localheinz]

## [`3.1.0`][3.1.0]

For a full diff see [`3.0.2...3.1.0`][3.0.2...3.1.0].

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#475]), by [@dependabot]
- Enabled `declare_parentheses` fixer ([#476]), by [@localheinz]
- Enabled and configured `empty_loop_body` fixer ([#477]), by [@localheinz]
- Enabled and configured `types_spaces` fixer ([#478]), by [@localheinz]
- Configured `class_attributes_separation` fixer to use newly added `only_if_meta` option for elements `const` and `property` ([#479]), by [@localheinz]
- Configured `class_attributes_separation` fixer to use `none` option for element `trait_import` ([#480]), by [@localheinz]
- Added `template` to `ignored_tags` configuration of `doctrine_*` fixers ([#481]), by [@localheinz]
- Configured `single_space_after_construct` fixer to enforce single space after additional constructs ([#483]), by [@localheinz]

## [`3.0.2`][3.0.2]

For a full diff see [`3.0.1...3.0.2`][3.0.1...3.0.2].

### Fixed

- Updated `friendsofphp/php-cs-fixer` ([#462]), by [@dependabot]

## [`3.0.1`][3.0.1]

For a full diff see [`3.0.0...3.0.1`][3.0.0...3.0.1].

### Fixed

- Fixed invalid configuration of `phpdoc_to_property_type` fixer in `Php74` and `Php80` rule sets ([#428]), by [@OskarStark]

## [`3.0.0`][3.0.0]

For a full diff see [`2.14.0...3.0.0`][2.14.0...3.0.0].

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#420]), by [@localheinz]
- Configured `function_to_constant` fixer to include `get_called_class()` ([#421]), by [@localheinz]
- Configured `phpdoc_align` fixer to include `@method` and `@property` annotations ([#422]), by [@localheinz]
- Configured `phpdoc_scalar` fixer to include `callback` ([#424]), by [@localheinz]

### Fixed

- Dropped support for PHP 7.2 ([#407]), by [@localheinz]
- Removed `Php71` rule set ([#409]), by [@localheinz]
- Removed `Php72` rule set ([#410]), by [@localheinz]
- Removed `Laravel6` rule set ([#413]), by [@localheinz]
- Removed `Faker` rule set ([#415]), by [@localheinz]
- Removed `PhpUnit` rule set ([#416]), by [@localheinz]

## [`2.14.0`][2.14.0]

For a full diff see [`2.13.1...2.14.0`][2.13.1...2.14.0].

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#400]), by [@dependabot]
- Configured `trailing_comma_in_multiline` fixer to add trailing commas for arguments in `Php73`, `Php74`, and `Php80` rule sets ([#403]), by [@localheinz]
- Configured `trailing_comma_in_multiline` fixer to add trailing commas for parameters in `Php80` rule set ([#404]), by [@localheinz]
- Enabled and configured `phpdoc_to_property_type` fixer in `Php74` and `Php80` rule sets ([#406]), by [@localheinz]

## [`2.13.1`][2.13.1]

For a full diff see [`2.13.0...2.13.1`][2.13.0...2.13.1].

### Fixed

- Stopped using deprecated configuration for `class_attributes_separation` fixer ([#354]), by [@localheinz]
- Updated `friendsofphp/php-cs-fixer` ([#392]), by [@dependabot]

## [`2.13.0`][2.13.0]

For a full diff see [`2.12.1...2.13.0`][2.12.1...2.13.0].

### Added

- Added `Ergebnis\PhpCsFixer\Config\RuleSet\Php80`, a rule set for PHP 8.0 ([#350]), by [@localheinz]
- Added `Ergebnis\PhpCsFixer\Config\RuleSet\Php72`, a rule set for PHP 7.2 ([#352]), by [@localheinz]

## [`2.12.1`][2.12.1]

For a full diff see [`2.12.0...2.12.1`][2.12.0...2.12.1].

### Fixed

- Updated `friendsofphp/php-cs-fixer` ([#348]), by [@dependabot]

## [`2.12.0`][2.12.0]

For a full diff see [`2.11.0...2.12.0`][2.11.0...2.12.0].

### Changed

- Configured `phpdoc_order_by_value` fixer to sort `@method`, `@property`, `@property-read`, and `@property-write` annotations in the `Php71`, `Php73`, `Php74` rule sets ([#344]), by [@localheinz]

### Fixed

- Updated `friendsofphp/php-cs-fixer` ([#343]), by [@dependabot]

## [`2.11.0`][2.11.0]

For a full diff see [`2.10.0...2.11.0`][2.10.0...2.11.0].

### Added

- Added `Ergebnis\PhpCsFixer\Config\RuleSet\Faker`, a rule set for `fakerphp/faker` ([#323]), by [@localheinz]

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#337]), by [@dependabot]

## [`2.10.0`][2.10.0]

For a full diff see [`2.9.0...2.10.0`][2.9.0...2.10.0].

### Added

- Added `Config\RuleSet\ExplicitRuleSet` marker interface for rule-sets that should  be configured explicitly ([#311]), by [@localheinz]

### Changed

- Required only implementations of `Config\RuleSet\ExplicitRuleSet` not to configure any rules for rule sets ([#313]), by [@localheinz]
- Required implementations of `Config\RuleSet\ExplicitRuleSet` to configure non-deprecated rules that are configurable with an explicit configuration when enabled ([#314]), by [@localheinz]
- Required implementations of `Config\RuleSet\ExplicitRuleSet` to configure non-deprecated rules that are configurable with all non-deprecated configuration options when enabled ([#320]), by [@localheinz]
- Required only implementations of `Config\RuleSet\ExplicitRuleSet` to configure all non-deprecated rules ([#321]), by [@localheinz]

### Fixed

- Stopped configuring rules using deprecated configuration options ([#319]), by [@localheinz]

## [`2.9.0`][2.9.0]

For a full diff see [`2.8.0...2.9.0`][2.8.0...2.9.0].

### Changed

- Enabled and configured `php_unit_test_case_static_method_calls` fixer for `Ergebnis\PhpCsFixer\Config\RuleSet\PhpUnit` ([#301]), by [@localheinz]
- Configured `phpdoc_order_by_value` fixer to order `@throws` annotations ([#302]), by [@localheinz]
- Enabled `php_unit_set_up_tear_down_visibility` fixer for `Ergebnis\PhpCsFixer\Config\RuleSet\PhpUnit` ([#303]), by [@localheinz]
- Enabled `allow_single_line_anonymous_class_with_empty_body` option for `braces` fixer ([#306]), by [@localheinz]
- Configured `phpdoc_order_by_value` fixer to order `@throws` annotations for `Ergebnis\PhpCsFixer\Config\RuleSet\PhpUnit` ([#310]), by [@localheinz]

### Fixed

- Updated `friendsofphp/php-cs-fixer` ([#304]), by [@dependabot]
- Updated `friendsofphp/php-cs-fixer` ([#309]), by [@dependabot]

## [`2.8.0`][2.8.0]

For a full diff see [`2.7.0...2.8.0`][2.7.0...2.8.0].

### Added

- Added `Ergebnis\PhpCsFixer\Config\RuleSet\PhpUnit`, a rule set for `phpunit/phpunit` ([#300]), by [@localheinz]

## [`2.7.0`][2.7.0]

For a full diff see [`2.6.1...2.7.0`][2.6.1...2.7.0].

### Changed

- Enabled `array_push` fixer ([#279]), by [@localheinz]
- Enabled `clean_namespace` fixer ([#280]), by [@localheinz]
- Enabled `lambda_not_used_import` fixer ([#281]), by [@localheinz]
- Enabled `no_alias_language_construct_call` fixer ([#282]), by [@localheinz]
- Enabled `no_trailing_whitespace_in_string` fixer ([#283]), by [@localheinz]
- Enabled `no_useless_sprintf` fixer ([#284]), by [@localheinz]
- Enabled and configured `operator_linebreak` fixer ([#285]), by [@localheinz]
- Enabled and configured `phpdoc_inline_tag_normalizer` fixer ([#286]), by [@localheinz]
- Enabled and configured `phpdoc_tag_casing` fixer ([#287]), by [@localheinz]
- Enabled `regular_callable_call` fixer ([#288]), by [@localheinz]
- Enabled and configured `single_space_after_construct` fixer ([#289]), by [@localheinz]
- Enabled `switch_continue_to_break` fixer ([#290]), by [@localheinz]
- Enabled `ternary_to_elvis_operator` fixer ([#291]), by [@localheinz]

## [`2.6.1`][2.6.1]

For a full diff see [`2.6.0...2.6.1`][2.6.0...2.6.1].

### Fixed

- Updated `friendsofphp/php-cs-fixer` ([#276]), by [@localheinz]

## [`2.6.0`][2.6.0]

For a full diff see [`2.5.3...2.6.0`][2.5.3...2.6.0].

### Changed

- Updated `friendsofphp/php-cs-fixer` ([#255]), by [@localheinz]
- Configured `phpdoc_order_by_value` fixer to order `@dataProvider` annotations by value ([#257]), by [@localheinz]
- Configured `phpdoc_order_by_value` fixer to order `@uses` annotations by value ([#258]), by [@localheinz]
- Configured `phpdoc_order_by_value` fixer to order `@author` annotations by value ([#259]), by [@localheinz]
- Configured `phpdoc_order_by_value` fixer to order `@coversNothing` annotations by value ([#260]), by [@localheinz]
- Configured `phpdoc_order_by_value` fixer to order `@depends` annotations by value ([#261]), by [@localheinz]
- Configured `phpdoc_order_by_value` fixer to order `@group` annotations by value ([#262]), by [@localheinz]
- Configured `phpdoc_order_by_value` fixer to order `@internal` annotations by value ([#263]), by [@localheinz]
- Configured `phpdoc_order_by_value` fixer to order `@requires` annotations by value ([#264]), by [@localheinz]
- Allowed installation on PHP 8.0 ([#265]), by [@Nyholm]

## [`2.5.3`][2.5.3]

For a full diff see [`2.5.2...2.5.3`][2.5.2...2.5.3].

### Fixed

- Disabled `heredoc_indentaton` fixer ([#247]), by [@localheinz]

## [`2.5.2`][2.5.2]

For a full diff see [`2.5.1...2.5.2`][2.5.1...2.5.2].

### Fixed

- Enabled and configured proxied instead of deprecated fixers ([#241]), by [@localheinz]

## [`2.5.1`][2.5.1]

For a full diff see [`2.5.0...2.5.1`][2.5.0...2.5.1].

### Fixed

- Updated `friendsofphp/php-cs-fixer` ([#226]), by [@dependabot]

## [`2.5.0`][2.5.0]

For a full diff see [`2.4.0...2.5.0`][2.4.0...2.5.0].

### Changed

- Configured the `phpdoc_add_missing_param_annotation` fixer to add annotation for untyped parameters only ([#220]), by [@localheinz]

## [`2.4.0`][2.4.0]

For a full diff see [`2.3.0...2.4.0`][2.3.0...2.4.0].

### Changed

- Enabled `no_superfluous_phpdoc_tags` fixer ([#215]), by [@localheinz]

## [`2.3.0`][2.3.0]

For a full diff see [`2.2.2...2.3.0`][2.2.2...2.3.0].

### Added

- Added `RuleSet\Php74` for use with PHP 7.4 ([#200]), by [@localheinz]

## [`2.2.2`][2.2.2]

For a full diff see [`2.2.1...2.2.2`][2.2.1...2.2.2].

### Changed

- Dropped support for PHP 7.1 ([#168]), by [@localheinz]

## [`2.2.1`][2.2.1]

For a full diff see [`2.2.0...2.2.1`][2.2.0...2.2.1].

### Fixed

- Updated `friendsofphp/php-cs-fixer` ([#135]), by [@dependabot]

## [`2.2.0`][2.2.0]

For a full diff see [`2.1.2...2.2.0`][2.1.2...2.2.0].

### Changed

- Configured `ordered_imports` fixer to group imports by kind ([#133]), by [@localheinz]

## [`2.1.0`][2.1.0]

For a full diff see [`2.0.0...2.1.0`][2.0.0...2.1.0].

### Changed

- Configured `php_unit_dedicate_assert` fixer to target `newest` versions of `phpunit/phpunit` ([#73]), by [@localheinz]

## [`2.0.0`][2.0.0]

For a full diff see [`1.1.3...2.0.0`][1.1.3...2.0.0].

### Removed

- Removed classes uses for construction of header, use [`ergebnis/license`](https://github.com/ergebnis/license) instead ([#50]), by [@localheinz]

## [`1.1.3`][1.1.3]

For a full diff see [`1.1.2...1.1.3`][1.1.2...1.1.3].

### Added

- Allowed construction of header ([#23]), by [@localheinz]

## [`1.1.2`][1.1.2]

For a full diff see [`1.1.1...1.1.2`][1.1.1...1.1.2].

### Fixed

- Brought back support for PHP 7.1 ([#17]), by [@localheinz]

## [`1.1.1`][1.1.1]

For a full diff see [`1.1.0...1.1.1`][1.1.0...1.1.1].

### Fixed

- Removed an inappropriate `replace` configuration from `composer.json` ([#14]), by [@localheinz]

## [`1.1.0`][1.1.0]

For a full diff see [`1.0.0...1.1.0`][1.0.0...1.1.0].

### Added

- Added `Ergebnis\PhpCsFixer\Config\RuleSet\Laravel6`, a rule set for Laravel 6 ([#3]), by [@linuxjuggler]

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
[2.14.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/2.14.0
[3.0.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/3.0.0
[3.0.1]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/3.0.1
[3.0.2]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/3.0.2
[3.1.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/3.1.0
[3.2.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/3.2.0
[3.3.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/3.3.0
[3.4.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/3.4.0
[4.0.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/4.0.0
[4.1.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/4.1.0
[4.2.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/4.2.0
[4.3.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/4.3.0
[4.4.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/4.4.0
[4.5.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/4.5.0
[4.5.1]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/4.5.1
[4.5.2]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/4.5.2
[4.5.3]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/4.5.3
[4.6.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/4.6.0
[4.7.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/4.7.0
[4.8.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/4.8.0
[4.9.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/4.9.0
[4.10.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/4.10.0
[4.11.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/4.11.0
[5.0.0]: https://github.com/ergebnis/php-cs-fixer-config/releases/tag/5.0.0

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
[2.13.1...2.14.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.13.1...2.14.0
[2.14.0...3.0.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/2.14.0...3.0.0
[3.0.0...3.0.1]: https://github.com/ergebnis/php-cs-fixer-config/compare/3.0.0...3.0.1
[3.0.1...3.0.2]: https://github.com/ergebnis/php-cs-fixer-config/compare/3.0.1...3.0.2
[3.0.2...3.1.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/3.0.2...3.1.0
[3.1.0...3.2.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/3.1.0...3.2.0
[3.2.0...3.3.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/3.2.0...3.3.0
[3.3.0...3.4.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/3.3.0...3.4.0
[3.4.0...3.4.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/3.4.0...4.0.0
[4.0.0...4.1.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/4.0.0...4.1.0
[4.1.0...4.2.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/4.1.0...4.2.0
[4.2.0...4.3.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/4.2.0...4.3.0
[4.3.0...4.4.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/4.3.0...4.4.0
[4.4.0...4.5.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/4.4.0...4.5.0
[4.5.0...4.5.1]: https://github.com/ergebnis/php-cs-fixer-config/compare/4.5.0...4.5.1
[4.5.1...4.5.2]: https://github.com/ergebnis/php-cs-fixer-config/compare/4.5.1...4.5.2
[4.5.2...4.5.3]: https://github.com/ergebnis/php-cs-fixer-config/compare/4.5.2...4.5.3
[4.5.3...4.6.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/4.5.3...4.6.0
[4.6.0...4.7.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/4.6.0...4.7.0
[4.7.0...4.8.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/4.7.0...4.8.0
[4.8.0...4.9.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/4.8.0...4.9.0
[4.9.0...4.10.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/4.9.0...4.10.0
[4.10.0...4.11.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/4.10.0...4.11.0
[4.11.0...5.0.0]: https://github.com/ergebnis/php-cs-fixer-config/compare/4.11.0...5.0.0
[5.0.0...main]: https://github.com/ergebnis/php-cs-fixer-config/compare/5.0.0...main

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
[#403]: https://github.com/ergebnis/php-cs-fixer-config/pull/403
[#404]: https://github.com/ergebnis/php-cs-fixer-config/pull/404
[#406]: https://github.com/ergebnis/php-cs-fixer-config/pull/406
[#407]: https://github.com/ergebnis/php-cs-fixer-config/pull/407
[#409]: https://github.com/ergebnis/php-cs-fixer-config/pull/409
[#410]: https://github.com/ergebnis/php-cs-fixer-config/pull/410
[#413]: https://github.com/ergebnis/php-cs-fixer-config/pull/413
[#415]: https://github.com/ergebnis/php-cs-fixer-config/pull/415
[#416]: https://github.com/ergebnis/php-cs-fixer-config/pull/416
[#420]: https://github.com/ergebnis/php-cs-fixer-config/pull/420
[#421]: https://github.com/ergebnis/php-cs-fixer-config/pull/421
[#422]: https://github.com/ergebnis/php-cs-fixer-config/pull/422
[#424]: https://github.com/ergebnis/php-cs-fixer-config/pull/424
[#428]: https://github.com/ergebnis/php-cs-fixer-config/pull/428
[#462]: https://github.com/ergebnis/php-cs-fixer-config/pull/462
[#475]: https://github.com/ergebnis/php-cs-fixer-config/pull/475
[#476]: https://github.com/ergebnis/php-cs-fixer-config/pull/476
[#477]: https://github.com/ergebnis/php-cs-fixer-config/pull/477
[#478]: https://github.com/ergebnis/php-cs-fixer-config/pull/478
[#479]: https://github.com/ergebnis/php-cs-fixer-config/pull/479
[#480]: https://github.com/ergebnis/php-cs-fixer-config/pull/480
[#481]: https://github.com/ergebnis/php-cs-fixer-config/pull/481
[#483]: https://github.com/ergebnis/php-cs-fixer-config/pull/483
[#495]: https://github.com/ergebnis/php-cs-fixer-config/pull/495
[#496]: https://github.com/ergebnis/php-cs-fixer-config/pull/496
[#497]: https://github.com/ergebnis/php-cs-fixer-config/pull/497
[#498]: https://github.com/ergebnis/php-cs-fixer-config/pull/498
[#499]: https://github.com/ergebnis/php-cs-fixer-config/pull/499
[#500]: https://github.com/ergebnis/php-cs-fixer-config/pull/500
[#501]: https://github.com/ergebnis/php-cs-fixer-config/pull/501
[#502]: https://github.com/ergebnis/php-cs-fixer-config/pull/502
[#503]: https://github.com/ergebnis/php-cs-fixer-config/pull/503
[#510]: https://github.com/ergebnis/php-cs-fixer-config/pull/510
[#513]: https://github.com/ergebnis/php-cs-fixer-config/pull/513
[#521]: https://github.com/ergebnis/php-cs-fixer-config/pull/521
[#527]: https://github.com/ergebnis/php-cs-fixer-config/pull/527
[#540]: https://github.com/ergebnis/php-cs-fixer-config/pull/540
[#544]: https://github.com/ergebnis/php-cs-fixer-config/pull/544
[#545]: https://github.com/ergebnis/php-cs-fixer-config/pull/545
[#553]: https://github.com/ergebnis/php-cs-fixer-config/pull/553
[#565]: https://github.com/ergebnis/php-cs-fixer-config/pull/565
[#566]: https://github.com/ergebnis/php-cs-fixer-config/pull/566
[#567]: https://github.com/ergebnis/php-cs-fixer-config/pull/567
[#578]: https://github.com/ergebnis/php-cs-fixer-config/pull/578
[#579]: https://github.com/ergebnis/php-cs-fixer-config/pull/579
[#580]: https://github.com/ergebnis/php-cs-fixer-config/pull/580
[#581]: https://github.com/ergebnis/php-cs-fixer-config/pull/581
[#583]: https://github.com/ergebnis/php-cs-fixer-config/pull/583
[#584]: https://github.com/ergebnis/php-cs-fixer-config/pull/584
[#586]: https://github.com/ergebnis/php-cs-fixer-config/pull/586
[#587]: https://github.com/ergebnis/php-cs-fixer-config/pull/587
[#588]: https://github.com/ergebnis/php-cs-fixer-config/pull/588
[#591]: https://github.com/ergebnis/php-cs-fixer-config/pull/591
[#592]: https://github.com/ergebnis/php-cs-fixer-config/pull/592
[#593]: https://github.com/ergebnis/php-cs-fixer-config/pull/593
[#620]: https://github.com/ergebnis/php-cs-fixer-config/pull/620
[#621]: https://github.com/ergebnis/php-cs-fixer-config/pull/621
[#622]: https://github.com/ergebnis/php-cs-fixer-config/pull/622
[#623]: https://github.com/ergebnis/php-cs-fixer-config/pull/623
[#624]: https://github.com/ergebnis/php-cs-fixer-config/pull/624
[#625]: https://github.com/ergebnis/php-cs-fixer-config/pull/625
[#626]: https://github.com/ergebnis/php-cs-fixer-config/pull/626
[#627]: https://github.com/ergebnis/php-cs-fixer-config/pull/627
[#628]: https://github.com/ergebnis/php-cs-fixer-config/pull/628
[#629]: https://github.com/ergebnis/php-cs-fixer-config/pull/629
[#630]: https://github.com/ergebnis/php-cs-fixer-config/pull/630
[#632]: https://github.com/ergebnis/php-cs-fixer-config/pull/632
[#633]: https://github.com/ergebnis/php-cs-fixer-config/pull/633
[#636]: https://github.com/ergebnis/php-cs-fixer-config/pull/636
[#637]: https://github.com/ergebnis/php-cs-fixer-config/pull/637
[#642]: https://github.com/ergebnis/php-cs-fixer-config/pull/642
[#644]: https://github.com/ergebnis/php-cs-fixer-config/pull/644
[#645]: https://github.com/ergebnis/php-cs-fixer-config/pull/645
[#646]: https://github.com/ergebnis/php-cs-fixer-config/pull/646
[#651]: https://github.com/ergebnis/php-cs-fixer-config/pull/651
[#655]: https://github.com/ergebnis/php-cs-fixer-config/pull/655
[#661]: https://github.com/ergebnis/php-cs-fixer-config/pull/661
[#662]: https://github.com/ergebnis/php-cs-fixer-config/pull/662
[#667]: https://github.com/ergebnis/php-cs-fixer-config/pull/667
[#672]: https://github.com/ergebnis/php-cs-fixer-config/pull/672
[#673]: https://github.com/ergebnis/php-cs-fixer-config/pull/673
[#684]: https://github.com/ergebnis/php-cs-fixer-config/pull/684

[@dependabot]: https://github.com/apps/dependabot
[@linuxjuggler]: https://github.com/linuxjuggler
[@localheinz]: https://github.com/localheinz
[@Nyholm]: https://github.com/Nyholm
[@OskarStark]: https://github.com/OskarStark

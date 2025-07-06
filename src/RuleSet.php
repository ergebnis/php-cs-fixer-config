<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019-2025 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config;

/**
 * @no-named-arguments
 */
final class RuleSet
{
    private Rules $rules;
    private PhpVersion $phpVersion;
    private Name $name;
    private Fixers $customFixers;

    private function __construct(
        Fixers $customFixers,
        Name $name,
        PhpVersion $phpVersion,
        Rules $rules
    ) {
        $this->customFixers = $customFixers;
        $this->name = $name;
        $this->phpVersion = $phpVersion;
        $this->rules = $rules;
    }

    public static function create(
        Fixers $customFixers,
        Name $name,
        PhpVersion $phpVersion,
        Rules $rules
    ): self {
        return new self(
            $customFixers,
            $name,
            $phpVersion,
            $rules,
        );
    }

    /**
     * Returns custom fixers required by this rule set.
     */
    public function customFixers(): Fixers
    {
        return $this->customFixers;
    }

    /**
     * Returns the name of the rule set.
     */
    public function name(): Name
    {
        return $this->name;
    }

    /**
     * Returns the minimum required PHP version.
     */
    public function phpVersion(): PhpVersion
    {
        return $this->phpVersion;
    }

    /**
     * Returns rules along with their configuration.
     */
    public function rules(): Rules
    {
        return $this->rules;
    }

    /**
     * Returns a new rule set with custom fixers.
     */
    public function withCustomFixers(Fixers $customFixers): self
    {
        return new self(
            $this->customFixers->merge($customFixers),
            $this->name,
            $this->phpVersion,
            $this->rules,
        );
    }

    /**
     * Returns a new rule set with merged rules.
     */
    public function withRules(Rules $rules): self
    {
        return new self(
            $this->customFixers,
            $this->name,
            $this->phpVersion,
            $this->rules->merge($rules),
        );
    }

    /**
     * Returns a new rule set with rules where the header_comment fixer is enabled to add a header.
     *
     * @see https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/v3.27.0/doc/rules/comment/header_comment.rst
     */
    public function withHeader(string $header): self
    {
        return new self(
            $this->customFixers,
            $this->name,
            $this->phpVersion,
            $this->rules->merge(Rules::fromArray([
                'header_comment' => [
                    'comment_type' => 'PHPDoc',
                    'header' => \trim($header),
                    'location' => 'after_declare_strict',
                    'separate' => 'both',
                ],
            ])),
        );
    }
}

<?php

namespace Ergebnis\PhpCsFixer\Config\RuleSet;

use Ergebnis\PhpCsFixer\Config\RuleSet;

interface PhpRuleSet
{
    public static function create(): RuleSet;
}

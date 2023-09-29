<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019-2023 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE.md file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config\Test\Rector;

use PhpParser\Node;
use PHPStan\Analyser;
use PHPStan\Reflection;
use PHPUnit\Framework;
use Rector\Core;
use Symplify\RuleDocGenerator;

/**
 * @internal
 */
final class SortAssociativeArrayByKey extends Core\Rector\AbstractRector
{
    public function getRuleDefinition(): RuleDocGenerator\ValueObject\RuleDefinition
    {
        return new RuleDocGenerator\ValueObject\RuleDefinition(
            'Sort associative arrays by key.',
            [
                new RuleDocGenerator\ValueObject\CodeSample\CodeSample(
                    <<<'CODE_SAMPLE'
$item = [
    'foo' => 1,
    'bar' => 2,
];
CODE_SAMPLE
                    ,
                    <<<'CODE_SAMPLE'
$item = [
    'bar' => 2,
    'foo' => 1,
];
CODE_SAMPLE
                ),
            ],
        );
    }

    public function getNodeTypes(): array
    {
        return [
            Node\Expr\Array_::class,
        ];
    }

    public function refactor(Node $node): ?Node
    {
        if (!$node instanceof Node\Expr\Array_) {
            return null;
        }

        if ($this->isScopeInTest($node)) {
            return null;
        }

        /** @var array<int, Node\Expr\ArrayItem> $items */
        $items = \array_filter($node->items, static function ($item): bool {
            if (!$item instanceof Node\Expr\ArrayItem) {
                return false;
            }

            if (!$item->key instanceof Node\Scalar\String_) {
                return false;
            }

            return true;
        });

        if ($items !== $node->items) {
            return null;
        }

        \usort($items, static function (Node\Expr\ArrayItem $a, Node\Expr\ArrayItem $b): int {
            if (!$a->key instanceof Node\Scalar\String_) {
                throw new \RuntimeException('This should not happen.');
            }

            if (!$b->key instanceof Node\Scalar\String_) {
                throw new \RuntimeException('This should not happen.');
            }

            return \strcmp(
                $a->key->value,
                $b->key->value,
            );
        });

        $node->items = $items;

        return $node;
    }

    private function isScopeInTest(Node $node): bool
    {
        $scope = $node->getAttribute('scope');

        if (!$scope instanceof Analyser\Scope) {
            return false;
        }

        if (!$scope->isInClass()) {
            return false;
        }

        $classReflection = $scope->getClassReflection();

        if (!$classReflection instanceof Reflection\ClassReflection) {
            return false;
        }

        if (!$classReflection->isSubclassOf(Framework\TestCase::class)) {
            return false;
        }

        return true;
    }
}

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

namespace Ergebnis\PhpCsFixer\Config\Test\Unit\Rector\SortAssociativeArrayByKey;

use Ergebnis\PhpCsFixer;
use PHPUnit\Framework;
use Rector\Testing;

#[Framework\Attributes\CoversClass(PhpCsFixer\Config\Test\Rector\SortAssociativeArrayByKey::class)]
final class SortAssociativeArrayByKeyTest extends Testing\PHPUnit\AbstractRectorTestCase
{
    #[Framework\Attributes\DataProvider('provideData')]
    public function test(string $filePath): void
    {
        $this->doTestFile($filePath);
    }

    public static function provideData(): \Iterator
    {
        return self::yieldFilesFromDirectory(__DIR__ . '/../../../Fixture/Rector/SortAssociativeArrayByKey/');
    }

    public function provideConfigFilePath(): string
    {
        return __DIR__ . '/config/configured_rule.php';
    }
}

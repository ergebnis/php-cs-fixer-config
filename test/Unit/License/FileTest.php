<?php

declare(strict_types=1);

/**
 * Copyright (c) 2019 Andreas Möller
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ergebnis/php-cs-fixer-config
 */

namespace Ergebnis\PhpCsFixer\Config\Test\Unit\License;

use Ergebnis\PhpCsFixer\Config\License\Copyright\Holder;
use Ergebnis\PhpCsFixer\Config\License\Copyright\Year;
use Ergebnis\PhpCsFixer\Config\License\Copyright\Years;
use Ergebnis\PhpCsFixer\Config\License\File;
use Ergebnis\PhpCsFixer\Config\License\Template;
use Ergebnis\Test\Util\Helper;
use PHPUnit\Framework;
use Symfony\Component\Filesystem;

/**
 * @internal
 *
 * @covers \Ergebnis\PhpCsFixer\Config\License\File
 *
 * @uses \Ergebnis\PhpCsFixer\Config\License\Copyright\Holder
 * @uses \Ergebnis\PhpCsFixer\Config\License\Copyright\Year
 * @uses \Ergebnis\PhpCsFixer\Config\License\Copyright\Years
 * @uses \Ergebnis\PhpCsFixer\Config\License\Template
 */
final class FileTest extends Framework\TestCase
{
    use Helper;

    protected function setUp(): void
    {
        $filesystem = new Filesystem\Filesystem();

        $filesystem->mkdir(self::directory());
    }

    protected function tearDown(): void
    {
        $filesystem = new Filesystem\Filesystem();

        $filesystem->remove(self::directory());
    }

    public function testCreateReturnsFile(): void
    {
        $faker = self::faker();

        $years = Years::fromYear(Year::fromString($faker->dateTime->format('Y')));
        $holder = Holder::fromString($faker->name);

        $template = Template::fromString(
            <<<'EOF'
Ah!

This was done in <copyright-years> by <copyright-holder>.

Who would have thought?

EOF
        );

        $file = File::create(
            $years,
            $holder,
            $template
        );

        $expected = <<<EOF
Ah!

This was done in {$years->toString()} by {$holder->toString()}.

Who would have thought?

EOF;

        self::assertSame($expected, $file->toString());

        $filename = \sprintf(
            '%s/%s',
            self::directory(),
            'example.txt'
        );

        $file->saveAs($filename);

        self::assertFileExists($filename);
        self::assertSame($expected, \file_get_contents($filename));
    }

    private static function directory(): string
    {
        return __DIR__ . '/../../../.build/test';
    }
}

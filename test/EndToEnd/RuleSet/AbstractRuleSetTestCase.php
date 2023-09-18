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

namespace Ergebnis\PhpCsFixer\Config\Test\EndToEnd\RuleSet;

use PhpCsFixer\Console\Command;
use PHPUnit\Framework;
use Symfony\Component\Console;
use Symfony\Component\Filesystem;
use Symfony\Component\Process;

abstract class AbstractRuleSetTestCase extends Framework\TestCase
{
    final protected function setUp(): void
    {
        self::fileSystem()->mkdir(self::temporaryDirectory());

        self::fileSystem()->dumpFile(
            self::configPath(),
            self::configContents(),
        );
    }

    final protected function tearDown(): void
    {
        self::fileSystem()->remove(self::temporaryDirectory());
    }

    final public function testConfigurationIsConsideredValid(): void
    {
        $process = new Process\Process(
            [
                'vendor/bin/php-cs-fixer',
                'fix',
                \sprintf(
                    '--config=%s',
                    self::configPath(),
                ),
                '--dry-run',
                self::configPath(),
            ],
            null,
            [
                /**
                 * @see https://github.com/PHP-CS-Fixer/PHP-CS-Fixer/blob/v3.13.1/php-cs-fixer#L31-L44
                 */
                'PHP_CS_FIXER_IGNORE_ENV' => true,
            ],
        );

        $process->run();

        $exitCode = $process->getExitCode();

        self::assertNotNull($exitCode);
        self::assertSame(0, Console\Command\Command::FAILURE & $exitCode, \sprintf(
            'Failed asserting that running friendsofphp/php-cs-fixer with the configuration in "%s" did not result in failure.',
            self::className(),
        ));
        self::assertSame(0, Command\FixCommandExitStatusCalculator::EXIT_STATUS_FLAG_HAS_INVALID_CONFIG & $exitCode, \sprintf(
            'Failed asserting that the configuration in "%s" is considered valid by friendsofphp/php-cs-fixer.',
            self::className(),
        ));
    }

    private static function fileSystem(): Filesystem\Filesystem
    {
        return new Filesystem\Filesystem();
    }

    private static function configPath(): string
    {
        return \sprintf(
            '%s/.php-cs-fixer.php',
            self::temporaryDirectory(),
        );
    }

    private static function configContents(): string
    {
        return \sprintf(
            <<<'PHP'
<?php

declare(strict_types=1);

$config = Ergebnis\PhpCsFixer\Config\Factory::fromRuleSet(%s::create(''));

$config->getFinder()
    ->exclude([
        '.build/',
        '.github/',
        '.notes/',
    ])
    ->ignoreDotFiles(false)
    ->in('%s')
    ->name('.php-cs-fixer.php');

$config->setUsingCache(false);

return $config;
PHP
            ,
            self::className(),
            self::projectDirectory(),
        );
    }

    /**
     * @psalm-return class-string
     *
     * @throws \RuntimeException
     */
    private static function className(): string
    {
        $className = \preg_replace(
            '/Test$/',
            '',
            \str_replace(
                '\Test\EndToEnd',
                '',
                static::class,
            ),
        );

        if (!\is_string($className)) {
            throw new \RuntimeException(\sprintf(
                'Failed resolving class name from test class name "%s".',
                static::class,
            ));
        }

        if (!\class_exists($className)) {
            throw new \RuntimeException(\sprintf(
                'Class name "%s" resolved from test class name "%s" does not reference a class that exists.',
                $className,
                static::class,
            ));
        }

        return $className;
    }

    private static function projectDirectory(): string
    {
        return __DIR__ . '/../../..';
    }

    private static function temporaryDirectory(): string
    {
        return __DIR__ . '/../../../.build/test';
    }
}

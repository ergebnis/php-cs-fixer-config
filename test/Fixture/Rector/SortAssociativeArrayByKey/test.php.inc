<?php

namespace Ergebnis\PhpCsFixer\Config\Test\Fixture\Rector\SortAssociativeArrayByKey;

use PHPUnit\Framework;

class ExampleTest extends Framework\TestCase
{
    public function data(): array
    {
        return [
            'foo' => [
                'foo',
                'bar',
                'baz',
            ],
            'bar' => [
                'quz' => 'qux',
                'quux' => 'quuz',
            ],
        ];
    }
}

?>
-----
<?php

namespace Ergebnis\PhpCsFixer\Config\Test\Fixture\Rector\SortAssociativeArrayByKey;

use PHPUnit\Framework;

class ExampleTest extends Framework\TestCase
{
    public function data(): array
    {
        return [
            'foo' => [
                'foo',
                'bar',
                'baz',
            ],
            'bar' => [
                'quz' => 'qux',
                'quux' => 'quuz',
            ],
        ];
    }
}

?>

<?php

namespace Ergebnis\PhpCsFixer\Config\Test\Fixture\Rector\SortAssociativeArrayByKey;

class Example
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

class Example
{
    public function data(): array
    {
        return [
            'bar' => [
                'quux' => 'quuz',
                'quz' => 'qux',
            ],
            'foo' => [
                'foo',
                'bar',
                'baz',
            ],
        ];
    }
}

?>

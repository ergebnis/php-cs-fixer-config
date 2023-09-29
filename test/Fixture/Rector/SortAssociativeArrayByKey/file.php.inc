<?php

namespace Ergebnis\PhpCsFixer\Config\Test\Fixture\Rector\SortAssociativeArrayByKey;

$data = [
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

?>
-----
<?php

namespace Ergebnis\PhpCsFixer\Config\Test\Fixture\Rector\SortAssociativeArrayByKey;

$data = [
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

?>

<?php

namespace App\Services\DocSchema\Parser;

use App\Services\DocSchema\Schema\ExampleSchema;
use App\Services\DocSchema\Schema\SlotSchema;
use Illuminate\Support\Arr;

class ComponentExampleParser extends BaseComponentParser
{

    public function getValue(string $componentClass)
    {
        $type = Arr::last(explode('\\', $componentClass));
        if($type === 'Button') {
            return [
                ExampleSchema::create('Successful Button', 'A successful button example',
                    [
                        'Useful for xyz',
                        'Can use any other type'
                    ],
                    [
                        'type' => 'success'
                    ],
                    [
                        SlotSchema::NO_KEY => '<strong>Button</strong> Content'
                    ]
                )
            ];
        }
        return [
            ExampleSchema::create('Example Option', 'Some select dropdown',
                [
                    'Useful for xyz',
                    'Can add or remove options'
                ],
                [
                    'items' => json_encode([
                        [
                            'label' => 'First option',
                            'value' => 1
                        ],
                        [
                            'label' => 'Second option',
                            'value' => 2
                        ],
                        [
                            'label' => 'Third option',
                            'value' => 3
                        ],
                    ])
                ],
                []
            )
        ];
    }
}

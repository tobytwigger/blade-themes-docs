<?php

namespace App\Services\DocSchema;

use App\Services\DocSchema\Schema\AllowedValueSchema;
use App\Services\DocSchema\Schema\AttributeSchema;
use App\Services\DocSchema\Schema\ComponentSchema;
use App\Services\DocSchema\Schema\ExampleSchema;
use App\Services\DocSchema\Schema\GroupSchema;
use App\Services\DocSchema\Schema\SlotSchema;

class Generator
{

    /**
     * @return GroupSchema[]
     */
    public function generate()
    {
        return [
            GroupSchema::create('Buttons', [
                ComponentSchema::create(
                    'Button',
                    'A simple button',
                    'button',
                    [
                        'Buttons can be used to execute actions',
                        'Another tip here'
                    ],
                    [
                        AttributeSchema::create(
                            'Type', 'type', 'The type of button',
                            [
                                AllowedValueSchema::create('success', 'Successful', [
                                    'Used for an action which will make an expected change', 'Also for...'
                                ]),
                                AllowedValueSchema::create('danger', 'Danger', [
                                    'Used for an action which will make an unreversible change', 'Also for...'
                                ]),
                                AllowedValueSchema::create('info', 'Info', [
                                    'Used for a toggle', 'Also for...'
                                ])
                            ]
                        ),
                        AttributeSchema::create(
                            'Dark Mode', 'dark', 'Whether to use the dark theme',
                            [
                                AllowedValueSchema::create('true', 'True', [
                                    'Use the dark mode'
                                ]),
                                AllowedValueSchema::create('false', 'False', [
                                    'Use the light mode'
                                ])
                            ]
                        )
                    ],
                    [
                        SlotSchema::create('Button Content', 'no key', 'The content to input into the button')
                    ],
                    [
                        ExampleSchema::create('Successful Button', 'A successful button example',
                            [
                                'Useful for xyz',
                                'Can use any other type'
                            ],
                            [
                                'type' => 'success'
                            ],
                            [
                                'no key' => '<strong>Button</strong> Content'
                            ]
                        )
                    ]
                )
            ])
        ];

        $component1_1 = new ComponentSchema();
    }

}

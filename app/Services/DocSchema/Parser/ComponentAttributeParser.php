<?php

namespace App\Services\DocSchema\Parser;

use App\Services\DocSchema\Schema\AllowedValueSchema;
use App\Services\DocSchema\Schema\AttributeSchema;
use Illuminate\Support\Arr;
use Psy\Util\Str;
use Twigger\Blade\Docs\DocDescription;
use Twigger\Blade\Docs\DocName;

class ComponentAttributeParser extends BaseComponentParser
{

    const SKIP_VARIABLES = [
        'componentName', 'attributes'
    ];

    public function getValue(string $componentClass)
    {
        // Iterate through every public property. For each one, get the var name, then the name and description attribute

        $attributes = [];


        $childClass = new \ReflectionClass($componentClass);
        $props = $childClass->getProperties(\ReflectionProperty::IS_PUBLIC);

        foreach($props as $prop) {
            if(in_array($prop->getName(), static::SKIP_VARIABLES)) {
                continue;
            }

            $attribute = new AttributeSchema();

            $name = $this->getPropertyAnnotation($componentClass, $prop->getName(), DocName::class);
            if($name !== null && $name->isValid()) {
                $attribute->setName($name->name);
            } else {
                $attribute->setName(\Illuminate\Support\Str::ucfirst($prop->getName()));
            }

            $description = $this->getPropertyAnnotation($componentClass, $prop->getName(), DocDescription::class);
            if($description !== null && $description->isValid()) {
                $attribute->setDescription($description->description);
            } else {
                $attribute->setDescription('No description given');
            }

            $attribute->setKey($prop->getName());

//            $attribute->setAllowedValues();
            $attributes[] = $attribute;
        }

        return $attributes;

        $type = Arr::last(explode('\\', $componentClass));
        if($type === 'Button') {
            return [
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
            ];
        }
        return [
            AttributeSchema::create(
                'Items', 'items', 'The items for the select',
                [
                    AllowedValueSchema::create(
                        json_encode([['label' => 'Item 1', 'value' => 1], ['label' => 'Item 2', 'value' => 2]]),
                        'Multiple select options',
                        ['something here']
                    )
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
        ];
    }
}

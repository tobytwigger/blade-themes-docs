<?php

namespace App\Services\DocSchema\Parser;

use App\Services\DocSchema\Schema\AllowedValueSchema;
use App\Services\DocSchema\Schema\AttributeSchema;
use Doctrine\Common\Annotations\Reader;
use Illuminate\Support\Arr;
use Twigger\Blade\Docs\DocAllowedValue;
use Twigger\Blade\Docs\DocDescription;
use Twigger\Blade\Docs\DocName;
use Illuminate\Support\Str;

class ComponentAttributeParser extends BaseComponentParser
{

    const SKIP_VARIABLES = [
        'componentName', 'attributes'
    ];

    public function getValue(string $componentClass)
    {
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

            $attribute->setKey(Str::kebab($prop->getName()));

            $startingClass = $componentClass;
            $allAllowedValues = [];
            $this->scanClassTree($startingClass, function($class) use ($prop, &$allAllowedValues) {
                $reflectionClass = new \ReflectionClass($class);
                if($reflectionClass->hasProperty($prop->getName())) {
                    $reflectionProperty = $reflectionClass->getProperty($prop->getName());
                    $allAllowedValues[] = array_values(array_filter($this->annotationReader->getPropertyAnnotations(
                        $reflectionProperty
                    ), function($property){
                        return $property instanceof DocAllowedValue;
                    }));
                }
            }, []);

            $allowedValues = [];
            $processedValues = [];
            foreach($allAllowedValues as $allowedValueFromClass)
            {
                foreach($allowedValueFromClass as $allowedValue) {
                    if(!in_array($allowedValue->value, $processedValues)) {
                        $allowedValues[] = $allowedValue;
                        $processedValues[] = $allowedValue->value;
                    }
                }
            }

            $allowedValues = array_map(function(DocAllowedValue $allowedValue) {
                return AllowedValueSchema::create(
                    $allowedValue->value,
                    $allowedValue->description,
                    $allowedValue->tips
                );
            }, $allowedValues);

            $attribute->setAllowedValues($allowedValues);

            $attributes[] = $attribute;
        }

        return $attributes;
    }
}

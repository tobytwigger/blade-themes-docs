<?php

namespace App\Services\DocSchema\Parser;

use App\Services\DocSchema\Schema\ExampleSchema;
use Twigger\Blade\Docs\DocExample;

class ComponentExampleParser extends BaseComponentParser
{

    public function getValue(string $componentClass)
    {
        $allExamples = [];

        $this->scanClassTree($componentClass, function ($class) use (&$allExamples) {
            $reflectionClass = new \ReflectionClass($class);
            $allExamples[] = array_values(array_filter($this->annotationReader->getClassAnnotations(
                $reflectionClass
            ), function ($property) {
                return $property instanceof DocExample;
            }));
        }, []);

        $examples = [];
        $processedValues = [];
        foreach ($allExamples as $examplesFromClass) {
            foreach ($examplesFromClass as $example) {
                if (!in_array($example->name, $processedValues)) {
                    $examples[] = $example;
                    $processedValues[] = $example->name;
                }
            }
        }

        return array_map(function (DocExample $example) {
            return ExampleSchema::create(
                $example->name,
                $example->description,
                $example->tips,
                $example->attributeValues,
                $example->getSlots()
            );
        }, $examples);
    }

}

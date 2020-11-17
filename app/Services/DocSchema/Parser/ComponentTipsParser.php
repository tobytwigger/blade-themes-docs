<?php

namespace App\Services\DocSchema\Parser;

use App\Services\DocSchema\Schema\TipSchema;
use Illuminate\Support\Arr;
use ReflectionClass;
use Twigger\Blade\Docs\DocTip;

class ComponentTipsParser extends BaseComponentParser
{
    public function getValue(string $componentClass)
    {
        $allTips = [];

        $this->scanClassTree($componentClass, function ($class) use (&$allTips) {
            $reflectionClass = new ReflectionClass($class);
            $allTips[] = array_values(array_filter($this->annotationReader->getClassAnnotations(
                $reflectionClass
            ), function ($property) {
                return $property instanceof DocTip;
            }));
        }, []);

        $tips = [];
        $processedValues = [];
        foreach ($allTips as $tipsFromClass) {
            foreach ($tipsFromClass as $tip) {
                if (!in_array($tip->tip, $processedValues)) {
                    $tips[] = $tip;
                    $processedValues[] = $tip->tip;
                }
            }
        }

        return array_map(function (DocTip $tip) {
            return $tip->tip;
        }, $tips);
    }
}

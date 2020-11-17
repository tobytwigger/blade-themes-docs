<?php

namespace App\Services\DocSchema\Parser;

use App\Services\DocSchema\Schema\SlotSchema;
use Illuminate\Support\Arr;
use Twigger\Blade\Docs\DocName;
use Twigger\Blade\Docs\DocSlot;

class ComponentSlotParser extends BaseComponentParser
{

    public function getValue(string $componentClass)
    {
        $allSlots = [];

        $this->scanClassTree($componentClass, function($class) use (&$allSlots) {
            $reflectionClass = new \ReflectionClass($class);
            $allSlots[] = array_values(array_filter($this->annotationReader->getClassAnnotations(
                    $reflectionClass
            ), function($property){
                return $property instanceof DocSlot;
            }));
        }, []);

        $slots = [];
        $processedValues = [];
        foreach($allSlots as $slotsFromClass)
        {
            foreach($slotsFromClass as $slot) {
                if(!in_array($slot->key ?? DocSlot::NO_KEY, $processedValues)) {
                    $slots[] = $slot;
                    $processedValues[] = $slot->key ?? DocSlot::NO_KEY;
                }
            }
        }

        return array_map(function(DocSlot $slot) {
            return SlotSchema::create(
                $slot->name,
                $slot->key ?? DocSlot::NO_KEY,
                $slot->description
            );
        }, $slots);
    }
}

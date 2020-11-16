<?php

namespace App\Services\DocSchema\Parser;

use App\Services\DocSchema\Schema\SlotSchema;
use Illuminate\Support\Arr;

class ComponentSlotParser extends BaseComponentParser
{

    public function getValue(string $componentClass)
    {
        $type = Arr::last(explode('\\', $componentClass));
        if($type === 'Button') {
            return [
                SlotSchema::create('Button Content', SlotSchema::NO_KEY, 'The content to input into the button')
            ];
        }
        return [];
    }
}

<?php

namespace App\Services\DocSchema\Parser;

use Illuminate\Support\Arr;

class ComponentTipsParser extends BaseComponentParser
{

    public function getValue(string $componentClass)
    {
        $type = Arr::last(explode('\\', $componentClass));
        if($type === 'Button') {
            return [
                'Buttons can be used to execute actions',
                'Another tip here'
            ];
        }
        return [
            'Selects can be used as alternatives to radio buttons',
            'Pair with a button for a xyz'
        ];
    }
}

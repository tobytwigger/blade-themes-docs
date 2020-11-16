<?php

namespace App\Services\DocSchema\Parser;

use Illuminate\Support\Arr;
use Twigger\Blade\Docs\DocName;

class ComponentNameParser extends BaseComponentParser
{

    public function getValue(string $componentClass)
    {
        $annotation = $this->getClassAnnotation($componentClass, DocName::class);
        if($annotation !== null && $this->annotationValid($annotation)) {
            return $annotation->name;
        }
        return Arr::last(explode('\\', $componentClass), null, 'Unnamed');
    }

}

<?php

namespace App\Services\DocSchema\Parser;

use Twigger\Blade\Docs\DocDescription;

class ComponentDescriptionParser extends BaseComponentParser
{

    public function getValue(string $componentClass)
    {
        $annotation = $this->getClassAnnotation($componentClass, DocDescription::class);
        if($annotation !== null && $this->annotationValid($annotation)) {
            return $annotation->description;
        }
        return 'No description provided';
    }

}

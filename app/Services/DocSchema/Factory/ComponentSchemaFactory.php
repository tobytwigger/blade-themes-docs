<?php

namespace App\Services\DocSchema\Factory;

use App\Services\DocSchema\Parser\BaseComponentParser as Parser;
use App\Services\DocSchema\Schema\ComponentSchema;

class ComponentSchemaFactory
{

    /**
     * @var Parser
     */
    private $nameParser;
    /**
     * @var Parser
     */
    private $descriptionParser;
    /**
     * @var Parser
     */
    private $tipParser;
    /**
     * @var Parser
     */
    private $attributeParser;
    /**
     * @var Parser
     */
    private $slotParser;
    /**
     * @var Parser
     */
    private $exampleParser;

    public function __construct(Parser $nameParser,
                                Parser $descriptionParser,
                                Parser $tipParser,
                                Parser $attributeParser,
                                Parser $slotParser,
                                Parser $exampleParser)
    {
        $this->nameParser = $nameParser;
        $this->descriptionParser = $descriptionParser;
        $this->tipParser = $tipParser;
        $this->attributeParser = $attributeParser;
        $this->slotParser = $slotParser;
        $this->exampleParser = $exampleParser;
    }

    /**
     * Create a component schema class for the given component
     *
     * @param string $componentClass The component to analyse
     * @return ComponentSchema
     * @throws \Exception
     */
    public function create(string $componentClass): ComponentSchema
    {
        return ComponentSchema::create(
            $this->nameParser->parse($componentClass),
            $this->descriptionParser->parse($componentClass),
            $componentClass::tag(),
            $this->tipParser->parse($componentClass),
            $this->attributeParser->parse($componentClass),
            $this->slotParser->parse($componentClass),
            $this->exampleParser->parse($componentClass)
        );
    }
}

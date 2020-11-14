<?php

namespace App\Services\DocSchema\Schema;

class ComponentSchema
{

    /**
     * Name of the component
     *
     * @var string
     */
    private $name;

    /**
     * Description of the component
     *
     * @var string
     */
    private $description;

    /**
     * The key to use to render the component
     *
     * @var string
     */
    private $key;

    /**
     * Tips about when or how to use the component, or things it may go well with
     *
     * @var string[]
     */
    private $tips = [];
    /**
     * Attributes the component can take
     *
     * @var AttributeSchema[]
     */
    private $attributes = [];
    /**
     * Slots the component allows
     *
     * @var SlotSchema[]
     */
    private $slots = [];
    /**
     * Examples for the component
     *
     * @var ExampleSchema[]
     */
    private $examples = [];

    public static function create(string $name = null,
                                  string $description = null,
                                  string $key = null,
                                  array $tips = [],
                                  array $attributes = [],
                                  array $slots = [],
                                  array $examples = [])
    {
        $schema = new static();
        $schema->setName($name);
        $schema->setDescription($description);
        $schema->setKey($key);
        $schema->setTips($tips);
        $schema->setAttributes($attributes);
        $schema->setSlots($slots);
        $schema->setExamples($examples);
        return $schema;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string[]
     */
    public function getTips(): array
    {
        return $this->tips;
    }

    /**
     * @param string[] $tips
     */
    public function setTips(array $tips): void
    {
        $this->tips = $tips;
    }

    /**
     * @return AttributeSchema[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param AttributeSchema[] $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     * @return SlotSchema[]
     */
    public function getSlots(): array
    {
        return $this->slots;
    }

    /**
     * @param SlotSchema[] $slots
     */
    public function setSlots(array $slots): void
    {
        $this->slots = $slots;
    }

    /**
     * @return ExampleSchema[]
     */
    public function getExamples(): array
    {
        return $this->examples;
    }

    /**
     * @param ExampleSchema[] $examples
     */
    public function setExamples(array $examples): void
    {
        $this->examples = $examples;
    }

}

<?php

namespace App\Services\DocSchema\Schema;

class ExampleSchema
{

    /**
     * The name of the example
     *
     * @var string
     */
    private $name;

    /**
     * The description of the example
     *
     * @var string
     */
    private $description;

    /**
     * Any tips on when the example should be used, alternative configurations or anything else
     *
     * @var array
     */
    private $tips = [];

    /**
     * An array of attributes to set on the example component
     *
     * @var array|mixed[]
     */
    private $attributeValues;
    /**
     * An array of slots to set on the component
     *
     * @var array|mixed[]
     */
    private $slots;

    public static function create(string $name = null,
                                  string $description = null,
                                  array $tips = [],
                                  array $attributeValues = [],
                                  array $slots = [])
    {
        $schema = new static();
        $schema->setName($name);
        $schema->setDescription($description);
        $schema->setTips($tips);
        $schema->setAttributeValues($attributeValues);
        $schema->setSlots($slots);
        return $schema;
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
     * @return array
     */
    public function getTips(): array
    {
        return $this->tips;
    }

    /**
     * @param array $tips
     */
    public function setTips(array $tips): void
    {
        $this->tips = $tips;
    }

    /**
     * @return array|mixed[]
     */
    public function getAttributeValues()
    {
        return $this->attributeValues;
    }

    /**
     * @param array|mixed[] $attributeValues
     */
    public function setAttributeValues($attributeValues): void
    {
        $this->attributeValues = $attributeValues;
    }

    /**
     * @return array|mixed[]
     */
    public function getSlots()
    {
        return $this->slots;
    }

    /**
     * @param array|mixed[] $slots
     */
    public function setSlots($slots): void
    {
        $this->slots = $slots;
    }

    public function htmlAttributes()
    {
        return collect($this->getAttributeValues())
            ->map(function($value, $key) {
                return sprintf('%s="%s"', $key, $value);
            })
            ->join(' ');
    }

    public function htmlSlots()
    {
        return collect($this->getSlots())
            ->map(function($value, $key) {
                if($key === SlotSchema::NO_KEY) {
                    return sprintf('%s', $value);
                }
                return sprintf('<x-slot name="%s">%s</x-slot>', $key, $value);
            })
            ->join(PHP_EOL);
    }

    public function htmlForComponent(string $componentKey, string $prefix)
    {
        return sprintf(
            '<x-%s-%s %s>%s</x-%s-%s>',
        $prefix, $componentKey, $this->htmlAttributes(), $this->htmlSlots(), $prefix, $componentKey);
    }

}

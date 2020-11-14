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
    private $values;
    /**
     * An array of slots to set on the component
     *
     * @var array|mixed[]
     */
    private $slots;

    public static function create(string $name = null,
                                  string $description = null,
                                  array $tips = [],
                                  array $values = [],
                                  array $slots = [])
    {
        $schema = new static();
        $schema->setName($name);
        $schema->setDescription($description);
        $schema->setTips($tips);
        $schema->setValues($values);
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
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param array|mixed[] $values
     */
    public function setValues($values): void
    {
        $this->values = $values;
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
}

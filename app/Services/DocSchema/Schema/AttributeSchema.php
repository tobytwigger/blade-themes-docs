<?php

namespace App\Services\DocSchema\Schema;

class AttributeSchema
{

    /**
     * The name of the attribute
     *
     * @var string
     */
    private $name;

    /**
     * The key for the attribute
     *
     * @var string
     */
    private $key;

    /**
     * A description about the attribute
     *
     * @var string
     */
    private $description;

    /**
     * A list of allowed values or rules for values to follow
     *
     * @var AllowedValueSchema[]
     */
    private $allowedValues = [];

    /**
     * @return AllowedValueSchema[]
     */
    public function getAllowedValues(): array
    {
        return $this->allowedValues;
    }

    /**
     * @param AllowedValueSchema[] $allowedValues
     */
    public function setAllowedValues(array $allowedValues): void
    {
        $this->allowedValues = $allowedValues;
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

    public function getExampleValue()
    {
        if(count($this->allowedValues) > 0) {
            return $this->allowedValues[0]->getValue();
        }
        return null;
    }

    public static function create(string $name = null,
                                  string $key = null,
                                  string $description = null,
                                  array $allowedValues = [])
    {
        $schema = new static();
        $schema->setName($name);
        $schema->setKey($key);
        $schema->setDescription($description);
        $schema->setAllowedValues($allowedValues);
        return $schema;
    }
}

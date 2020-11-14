<?php

namespace App\Services\DocSchema\Schema;

class SlotSchema
{

    /**
     * The name of the slot
     *
     * @var string
     */
    private $name;

    /**
     * The key for the slot
     *
     * @var string
     */
    private $key;

    /**
     * A description about the slot
     *
     * @var string
     */
    private $description;

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

    public static function create(string $name = null,
                                  string $key = null,
                                  string $description = null)
    {
        $schema = new static();
        $schema->setName($name);
        $schema->setKey($key);
        $schema->setDescription($description);
        return $schema;
    }

}

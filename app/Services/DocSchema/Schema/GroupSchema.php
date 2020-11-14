<?php

namespace App\Services\DocSchema\Schema;

class GroupSchema
{

    /**
     * Name of the group
     *
     * @var string
     */
    private $name;

    /**
     * @var ComponentSchema[]
     */
    private $components = [];

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
     * @return ComponentSchema[]
     */
    public function getComponents(): array
    {
        return $this->components;
    }

    /**
     * @param ComponentSchema[] $components
     */
    public function setComponents(array $components): void
    {
        $this->components = $components;
    }

    public static function create(string $name = null,
                                  array $components = [])
    {
        $schema = new static();
        $schema->setName($name);
        $schema->setComponents($components);
        return $schema;
    }

}


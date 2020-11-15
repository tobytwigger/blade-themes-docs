<?php

namespace App\Services\DocSchema\Schema;

class ThemeSchema
{

    /**
     * The name of the theme
     *
     * @var string
     */
    private $name;

    /**
     * The id of the theme
     *
     * @var string
     */
    private $id;

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
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
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

    /**
     * Components of components the theme has
     *
     * @var ComponentSchema[]
     */
    private $components = [];

}

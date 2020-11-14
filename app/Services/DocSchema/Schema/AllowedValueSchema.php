<?php

namespace App\Services\DocSchema\Schema;

class AllowedValueSchema
{
    /**
     * The value of the attribute
     *
     * @var string
     */
    private $value;
    /**
     * A description for the allowed value. Include what it changes and any relevant information.
     *
     * @var string
     */
    private $description;
    /**
     * Tips on using this value
     *
     * @var array
     */
    private $tips;

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
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

    public static function create(string $value = null,
                                  string $description = null,
                                  array $tips = [])
    {
        $schema = new static();
        $schema->setValue($value);
        $schema->setDescription($description);
        $schema->setTips($tips);
        return $schema;
    }

}

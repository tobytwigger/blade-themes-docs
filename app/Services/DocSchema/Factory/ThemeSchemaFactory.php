<?php

namespace App\Services\DocSchema\Factory;

use App\Services\DocSchema\Schema\ThemeSchema;
use Twigger\Blade\Foundation\ComponentLocator;
use Twigger\Blade\Foundation\SchemaStore;
use Twigger\Blade\Foundation\ThemeDefinition;

class ThemeSchemaFactory
{

    /**
     * @var SchemaStore
     */
    private $schemaStore;
    /**
     * @var ComponentLocator
     */
    private $componentLocator;
    /**
     * @var ComponentSchemaFactory
     */
    private $componentSchemaFactory;

    public function __construct(SchemaStore $schemaStore,
                                ComponentLocator $componentLocator,
                                ComponentSchemaFactory $componentSchemaFactory)
    {
        $this->schemaStore = $schemaStore;
        $this->componentLocator = $componentLocator;
        $this->componentSchemaFactory = $componentSchemaFactory;
    }

    public function create(ThemeDefinition $themeDefinition): ThemeSchema
    {
        $themeSchema = new ThemeSchema();
        $themeSchema->setName($themeDefinition->name());
        $themeSchema->setId($themeDefinition->id());
        $themeSchema->setComponents(
            collect($this->schemaStore->allSchemas())
                ->map(function($schema) {
                    return $this->componentSchemaFactory->create(
                        $this->componentLocator->getImplementationClassFromSchema($schema)
                    );
                })
                ->toArray()
        );

        return $themeSchema;
    }

}

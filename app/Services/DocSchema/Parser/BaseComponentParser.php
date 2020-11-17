<?php

namespace App\Services\DocSchema\Parser;

use Closure;
use Doctrine\Common\Annotations\Reader;
use Exception;
use Illuminate\Support\Arr;
use ReflectionClass;
use Twigger\Blade\Docs\BaseAnnotation;
use Twigger\Blade\Foundation\SchemaDefinition;

abstract class BaseComponentParser
{

    /**
     * @var Reader
     */
    protected $annotationReader;

    public function __construct(Reader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    public function parse(string $componentClass)
    {
        if (is_subclass_of($componentClass, SchemaDefinition::class)) {
            return $this->getValue($componentClass);
        }
        throw new Exception(sprintf('Component [%s] must be an instance of SchemaDefinition when generating documentation'), $componentClass);
    }

    abstract public function getValue(string $componentClass);

    /**
     * @param string $componentClass
     * @param string $annotation
     * @return BaseAnnotation
     * @throws \ReflectionException
     * @throws Exception
     */
    public function getClassAnnotation(string $componentClass, string $annotation): ?BaseAnnotation
    {
        return $this->scanClassTree($componentClass, function ($class) use ($annotation) {
            $reflectionClass = new ReflectionClass($class);

            return $this->annotationReader->getClassAnnotation(
                $reflectionClass,
                $annotation
            );
        }, null);
    }

    /**
     * @param string $componentClass
     * @param string $property
     * @param string $annotation
     * @return BaseAnnotation
     * @throws \ReflectionException
     */
    public function getPropertyAnnotation(string $componentClass, string $property, string $annotation): ?BaseAnnotation
    {
        return $this->scanClassTree($componentClass, function ($class) use ($annotation, $property) {
            $reflectionClass = new ReflectionClass($class);
            if($reflectionClass->hasProperty($property)) {
                $reflectionProperty = $reflectionClass->getProperty($property);
                return $this->annotationReader->getPropertyAnnotation(
                    $reflectionProperty,
                    $annotation
                );
            }
            return null;
        }, null);
    }

    /**
     * @param string $componentClass
     * @param string $property
     * @param string $annotation
     * @return BaseAnnotation[]
     * @throws \ReflectionException
     */
    public function getPropertyAnnotations(string $componentClass, string $property, string $annotation): array
    {
        $results = [];
        $annotationArrays = $this->sumClassTree($componentClass, function ($class) use ($annotation, $property) {
            $reflectionClass = new ReflectionClass($class);
            if($reflectionClass->hasProperty($property)) {
                $reflectionProperty = $reflectionClass->getProperty($property);
                return array_values(array_filter($this->annotationReader->getPropertyAnnotations(
                    $reflectionProperty
                ), function($property) use ($annotation){
                    return $property instanceof $annotation;
                }));
            }
            return [];
        });
    }

    public function scanClassTree(string $startingClass, Closure $extractor, $default = null)
    {
        do {
            $data = $extractor($startingClass);
            if ($data) {
                return $data;
            }
        } while (($startingClass = get_parent_class($startingClass)) !== false);
        return $default;
    }

    public function annotationValid(BaseAnnotation $annotation)
    {
        return $annotation->isValid();
    }
}

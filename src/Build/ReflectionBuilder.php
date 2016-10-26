<?php
declare (strict_types = 1);

namespace JildertMiedema\Fill\Build;

use JildertMiedema\Fill\TargetClassIsNotInstantiable;

final class ReflectionBuilder implements Builder
{
    /**
     * @var string
     */
    private $targetClass;

    /**
     * @var \ReflectionMethod
     */
    private $constructor;

    /**
     * @var string[]
     */
    private $publicProperties;

    /**
     * @var \ReflectionClass
     */
    private $reflector;

    /**
     * @var string[]
     */
    private $constructorParameters;

    public function __construct(string $targetClass)
    {
        $this->targetClass = $targetClass;
    }

    public function build(array $data)
    {
        $this->reflect();

        $class =  $this->buildClass($data);

        foreach ($this->publicProperties as $property) {
            $key = $property;
            if (isset($data[$key])) {
                $class->$key = $data[$key];
            }
        }

        return $class;
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    private function buildClass(array $data)
    {
        if (is_null($this->constructor)) {
            return new $this->targetClass;
        }

        $parameters = $this->getConstructorParameter($data);

        return $this->reflector->newInstanceArgs($parameters);
    }

    private function reflect()
    {
        $this->reflector = new \ReflectionClass($this->targetClass);
        if ( ! $this->reflector->isInstantiable()) {
            throw TargetClassIsNotInstantiable::withName($this->targetClass);
        }
        $this->constructor = $this->reflector->getConstructor();
        $this->publicProperties = array_map(function (\ReflectionProperty $property) {
            return $property->name;
        }, $this->reflector->getProperties(\ReflectionProperty::IS_PUBLIC));

        $this->constructorParameters = $this->constructor ? array_map(function (\ReflectionParameter $parameter) {
            return $parameter->name;
        }, $this->constructor->getParameters()) : [];
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function getConstructorParameter(array $data)
    {
        $parameters = [];
        foreach ($this->constructorParameters as $parameter) {
            if (isset($data[$parameter])) {
                $parameters[$parameter] = $data[$parameter];
            }
        }

        return $parameters;
    }
}

<?php

namespace App\Code\Framework\Build;

class Autoloader
{
    private array $definitions;

    public function __construct(array $definition = [])
    {
        $this->definitions = $definition;
    }

    public function set(string $name, $definition): void
    {
        $this->definitions[$name] = $definition;
    }

    public function get(string $name): ?object
    {
        if (!isset($this->definitions[$name])) {
            $reflection = new \ReflectionClass($name);

            if (!$reflection->isInstantiable()) {
                throw new \Exception("Class {$name} is not instantiable");
            }
    
            $constructor = $reflection->getConstructor();
    
            if (!$constructor) {
                return new $name;
            }
    
            $parameters = $constructor->getParameters();
            $dependencies = $this->getDependencies($parameters);
    
            return $reflection->newInstanceArgs($dependencies);
            throw new \Exception("Class {$name} not found in container");
        }

        $definition = $this->definitions[$name];

        if (is_callable($definition)) {
            return call_user_func($definition, $this);
        }

        return $definition;
    }

    public function hasDefinition(string $key)
    {
        return isset($this->definitions[$key]);
    }

    private function getDependencies(array $parameters): array
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();
            if (!$dependency) {
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new \Exception("Unable to resolve dependency");
                }
            } else {
                $dependencies[] = $this->get($dependency->name);
            }
        }
        return $dependencies;
    }
}

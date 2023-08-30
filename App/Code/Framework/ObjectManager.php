<?php

namespace App\Code\Framework;

use App\Code\Framework\Build\Autoloader;
use App\Code\Framework\Build\AutoloaderFactory;

class ObjectManager
{
    private static ?ObjectManager $objectManager = null;

    private Autoloader $autoloader;

    public function __construct(Autoloader $autoloader)
    {
        $this->autoloader = $autoloader;
    }

    public static function getInstance(): ?ObjectManager
    {
        if (!self::$objectManager) {
            $autoloaderFactory = new AutoloaderFactory();
            self::$objectManager = new ObjectManager($autoloaderFactory->create());
        }
        return self::$objectManager;
    }
    
    public static function createInstance(Autoloader $autoloader): void
    {
        self::$objectManager = new ObjectManager($autoloader);
    }

    public function get(string $className): ?object
    {
        $result = $this->autoloader->get($className);
        $this->autoloader->set($className, $result);
        return $result;
    }

    public function create(string $classname): ?object
    {
        $this->autoloader->set($classname, null);
        $result = $this->autoloader->get($className);
        $this->autoloader->set($className, $result);
        return $result;
        
    }

    public function setDefinition(string $key, $definition): void
    {
        $this->autoloader->set($key, $definition);
    }
}

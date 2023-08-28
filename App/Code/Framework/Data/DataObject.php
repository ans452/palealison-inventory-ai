<?php

namespace App\Code\Framework\Data;

class DataObject
{
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function __call($method, $args)
    {
        switch (substr($method, 0, 3)) {
            case 'get':
                $key = $this->toSnakeCase(substr($method, 3));
                return $this->getData($key);
            case 'set':
                $key = $this->toSnakeCase(substr($method, 3));
                $value = isset($args[0]) ? $args[0] : null;
                return $this->setData($key, $value);
            case 'uns':
                $key = $this->toSnakeCase(substr($method, 3));
                return $this->unsetData($key);
            case 'has':
                $key = $this->toSnakeCase(substr($method, 3));
                return isset($this->data[$key]);
        }
        throw new \Exception(sprintf('Invalid method %s::%s', get_class($this), $method));
    }


    public function getData(string $key = '')
    {
        if ($key) {
            return $this->data[$key] ?? null;
        }
        return $this->data;
    }

    public function setData(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function unsetData(string $key): void
    {
        unset($this->data[$key]);
    }

    private function toSnakeCase($camelCaseString): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $camelCaseString));
    }
}

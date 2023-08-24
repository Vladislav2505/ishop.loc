<?php

namespace core;

class Registry
{
    use TSingleton;

    protected static array $properties = [];

    public function setProperty(string $name, mixed $value): void
    {
        self::$properties[$name] = $value;
    }

    public function getProperty(string $name): mixed
    {
        return self::$properties[$name] ?? null;
    }

    public function getProperties(): array
    {
        return self::$properties;
    }
}
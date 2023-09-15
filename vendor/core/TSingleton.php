<?php

namespace core;

trait TSingleton
{
    private static self|null $instance = null;

    private function __construct()
    {
    }

    private function __clone(): void
    {
    }

    public static function getInstance(): static
    {
        return static::$instance ?? new static();
    }
}
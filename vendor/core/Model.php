<?php

namespace core;

abstract class Model
{
    protected array $attributes = [];
    protected array $errors = [];
    protected array $rules = [];
    protected array $labels = [];

    public function __construct()
    {
        Db::getInstance();
    }
}
<?php

namespace core;

use Exception;

abstract class Controller
{
    protected array $data = [];
    protected array $meta = [];
    protected string|false $layout = '';
    protected string $view = '';
    protected object $model;

    public function __construct(public array $route = [])
    {
    }

    public function setModel(): void
    {
        $model = "app\models\\" . $this->route['admin_prefix'] . $this->route['controller'];

        if (class_exists($model)) {
            $this->model = new $model();
        }
    }

    /**
     * @throws Exception
     */
    public function setView(): void
    {
        $this->view = $this->view ?: $this->route['action'];
        (new View($this->route, $this->layout, $this->view, $this->meta))->render($this->data);
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function setMeta(string $title = '', string $description = '', string $keywords = ''): void
    {
        $this->meta = [
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
        ];
    }
}
<?php

namespace core;

use Exception;
use JetBrains\PhpStorm\NoReturn;

abstract class Controller
{
    protected array $data = [];
    protected array $meta = ['title' => '', 'description' => '', 'keywords' => ''];
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

    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    #[NoReturn] public function loadView(string $view, array $vars = []): void
    {
        extract($vars);
        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
        require APP . "/views/{$prefix}{$this->route['controller']}/{$view}.php";
        die;
    }
}
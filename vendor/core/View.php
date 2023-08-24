<?php

namespace core;

use Exception;

class View
{
    public string $content = '';

    public function __construct(
        public array        $route,
        public string|false $layout = '',
        public string       $view = '',
        public array        $meta = [],
    )
    {
        if (false !== $this->layout) {
            $this->layout = $this->layout ?: LAYOUT;
        }
    }

    /**
     * @throws Exception
     */
    public function render($data): void
    {
        if (is_array($data)) {
            extract($data);
        }

        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
        $viewFile = APP . "/views/{$prefix}{$this->route['controller']}/{$this->view}.php";

        if (file_exists($viewFile)) {
            ob_start();
            require_once $viewFile;
            $this->content = ob_get_clean();
        } else {
            throw new Exception("Вид {$viewFile} не найден", 500);
        }

        if (false !== $this->layout) {
            $layoutFile = APP . "/views/layouts/{$this->layout}.php";

            if (file_exists($layoutFile)) {
                require_once $layoutFile;
            } else {
                throw new Exception("Шаблон {$layoutFile} не найден", 500);
            }
        }
    }

    public function getMeta(): string
    {
        return '<title>' . h($this->meta['title']) . '</title>' . PHP_EOL .
            '<meta name="description" content="' . h($this->meta['description']) . '">' . PHP_EOL .
            '<meta name="keywords" content="' . h($this->meta['keywords']) . '">' . PHP_EOL;
    }
}
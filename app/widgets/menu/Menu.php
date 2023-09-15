<?php

namespace app\widgets\menu;

use core\App;
use core\Cache;
use RedBeanPHP\R;

class Menu
{
    protected array $data = [];
    protected array $tree = [];
    protected string $menuHtml;
    protected string $tpl;
    protected string $container = 'ul';
    protected string $class = 'menu';
    protected int $cache = 3600;
    protected string $cacheKey = 'ishop_menu';
    protected array $attrs = [];
    protected string $prepend = '';
    protected array $language;

    public function __construct(array $options = [])
    {
        $this->language = App::$app->getProperty('lang');
        $this->tpl = __DIR__ . '/menu_tpl.php';
        $this->setOptions($options);
        $this->run();
    }

    protected function setOptions(array $options): void
    {
        foreach ($options as $k => $option) {
            if (property_exists($this, $k)) {
                $this->$k = $option;
            }
        }
    }

    protected function run(): void
    {
        $cache = Cache::getInstance();
        $this->menuHtml = $cache->get("{$this->cacheKey}_{$this->language['code']}");

        if (!$this->menuHtml) {
            $this->data = R::getAssoc("SELECT c.*, cd.* FROM `categories` as c 
                                        JOIN ishop.category_descriptions cd on c.id = cd.category_id 
                                        WHERE cd.language_id = ?", [$this->language['id']]);

            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);

            if ($this->cache) {
                $cache->set("{$this->cacheKey}_{$this->language['code']}", $this->menuHtml, $this->cache);
            }
        }

        $this->output();
    }

    protected function output(): void
    {
        $attrs = '';

        if (!empty($this->attrs)) {
            foreach ($this->attrs as $k => $attr) {
                $attrs .= " $k='$attr' ";
            }
        }

        echo "<{$this->container} class='{$this->class}' $attrs>";
        echo $this->prepend;
        echo $this->menuHtml;
        echo "</{$this->container}>";

    }

    protected function getTree(): array
    {
        $tree = [];
        $data = $this->data;

        foreach ($data as $k => &$node) {
            if (!$node['parent_id']) {
                $tree[$k] =& $node;
            } else {
                $data[$node['parent_id']]['children'][$k] =& $node;
            }
        }

        return $tree;
    }

    protected function getMenuHtml(array $tree, string $tab = ''): string
    {
        $str = '';

        foreach ($tree as $k => $category) {
            $str .= $this->catToTemplate($category, $tab, $k);
        }

        return $str;
    }

    protected function catToTemplate(array $category, string $tab, int $id): string
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }
}
<?php

namespace app\widgets\language;

use RedBeanPHP\R;

class Language
{
    protected string $tpl;
    protected array $languages;
    protected string $language;

    public function __construct()
    {
        $this->tpl = __DIR__ . 'lang_tpl.php';
        $this->run();
    }

    public function run()
    {

    }

    public static function getLanguages(): array
    {
        return R::getAssoc("SELECT code, title, base, id FROM languages ORDER BY base DESC");
    }
}
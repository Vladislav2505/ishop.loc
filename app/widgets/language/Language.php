<?php

namespace app\widgets\language;

use core\App;
use Exception;
use RedBeanPHP\R;

class Language
{
    protected string $tpl;
    protected array $languages;
    protected array $language;

    public function __construct()
    {
        $this->tpl = __DIR__ . '/lang_tpl.php';
        $this->run();
    }

    public function run(): void
    {
        $this->languages = App::$app->getProperty('languages');
        $this->language = App::$app->getProperty('lang');
        echo $this->getHtml();
    }

    public static function getLanguages(): array
    {
        return R::getAssoc("SELECT code, title, base, id  FROM languages ORDER BY base DESC");
    }

    /**
     * @throws Exception
     */
    public static function getLanguage(array $languages): array
    {
        $lang = App::$app->getProperty('url_lang');

        if ($lang && array_key_exists($lang, $languages)) {
            $key = $lang;
        } elseif (!$lang) {
            $key = key($languages);
        } else {
            throw new Exception("Не найден язык {$lang}");
        }

        $langInfo = $languages[$key];
        $langInfo['code'] = $key;
        return $langInfo;
    }

    protected function getHtml(): bool|string
    {
        ob_start();
        require_once $this->tpl;
        return ob_get_clean();
    }
}
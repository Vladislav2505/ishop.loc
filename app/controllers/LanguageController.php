<?php

namespace app\controllers;

use core\App;

class LanguageController extends AppController
{
    public function changeAction(): void
    {
        $lang = get('lang', 's');

        if ($lang) {
            if (array_key_exists($lang, App::$app->getProperty('languages'))) {
                $url = trim(str_replace(PATH, '', $_SERVER['HTTP_REFERER']), '/');
                $url_parts = explode('/', $url, 2);

                if (array_key_exists($url_parts[0], App::$app->getProperty('languages'))) {
                    if ($lang != App::$app->getProperty('lang')['code']) {
                        $url_parts[0] = $lang;
                    } else {
                        array_shift($url_parts);
                    }
                } else {
                    if ($lang != App::$app->getProperty('lang')['code']) {
                        array_unshift($url_parts, $lang);
                    }
                }

                $url = PATH . '/' . implode('/', $url_parts);
                redirect($url);
            }
        }

        redirect();
    }
}
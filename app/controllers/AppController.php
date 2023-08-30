<?php

namespace app\controllers;

use app\models\AppModel;
use app\widgets\language\Language;
use core\App;
use core\Controller;
use Exception;

class AppController extends Controller
{
    /**
     * @throws Exception
     */
    public function __construct(array $route)
    {
        parent::__construct($route);
        new AppModel();
        App::$app->setProperty('languages', Language::getLanguages());
        App::$app->setProperty('lang', Language::getLanguage(App::$app->getProperty('languages')));

        $lang = App::$app->getProperty('lang');
        \core\Language::load($lang['code'], $this->route);

        debug(\core\Language::$lang_data);
    }
}
<?php

namespace app\controllers;

use app\models\AppModel;
use app\widgets\language\Language;
use core\App;
use core\Controller;

class AppController extends Controller
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        new AppModel();
        App::$app->setProperty('languages', Language::getLanguages());
        debug(App::$app->getProperty('languages'));
    }
}
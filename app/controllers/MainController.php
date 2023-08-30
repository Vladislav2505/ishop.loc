<?php

namespace app\controllers;

use app\models\Main;
use core\App;
use core\Controller;
use core\Language;
use RedBeanPHP\R;

class MainController extends AppController
{
    public function indexAction(): void
    {
        $lang = App::$app->getProperty('lang')['id'];
        $this->setMeta(___('main_index_meta_title'), ___('main_index_meta_description'),
            ___('main_index_meta_keywords'));
        $slides = R::findAll('slider');
        $products = $this->model->getHits($lang, 6);
        $this->setData(compact('slides', 'products'));
    }
}
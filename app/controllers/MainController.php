<?php

namespace app\controllers;

use app\models\Main;
use core\App;
use core\Controller;
use RedBeanPHP\R;

class MainController extends AppController
{
    public function indexAction(): void
    {
        $this->setMeta('Главная страница', 'Description...', 'keywords...');
        $slides = R::findAll('slider');
        $products = $this->model->getHits(1, 6);
        $this->setData(compact('slides', 'products'));
    }
}
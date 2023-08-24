<?php

namespace app\controllers;

use app\models\Main;
use core\Controller;

class MainController extends Controller
{
    public function indexAction(): void
    {
        $this->setMeta('Главная', 'Description', 'keywords');
        $names = $this->model->getNames();

        $this->setData(compact('names'));
    }
}
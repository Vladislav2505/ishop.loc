<?php

namespace app\models;

use core\Model;
use RedBeanPHP\R;

class Main extends Model
{
    public function getNames(): array
    {
        return R::findAll('name');
    }
}
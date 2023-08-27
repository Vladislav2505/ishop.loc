<?php

namespace app\models;

use core\Model;
use RedBeanPHP\R;

class Main extends AppModel
{
    public function getHits(int $lang, int $limit): array
    {
        return R::getAll("SELECT p.*, pd.* FROM products as p 
            JOIN product_descriptions as pd on p.id = pd.product_id
            WHERE p.status = 1 AND p.hit = 1 AND pd.language_id = ? LIMIT $limit", [$lang]);
    }
}
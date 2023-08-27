<?php

namespace core;

use Exception;
use RedBeanPHP\R;

class Db
{
    use TSingleton;

    /**
     * @throws Exception
     */
    private function __construct()
    {
        $db = require_once CONFIG . '/config_db.php';

        if(!R::testConnection()){
            R::setup($db['dsn'], $db['user'], $db['password']);
        }

        if (!R::testConnection()) {
            throw new Exception('Нет подключения к БД', 500);
        }

        R::freeze(true);

        if (DEBUG) {
            R::debug(true, 3);
        }
    }
}
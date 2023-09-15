<?php

namespace core;

use Exception;

class App
{
    public static Registry $app;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $query = trim(urldecode($_SERVER['QUERY_STRING']), '/');
        new ErrorHandler();
        session_start();
        self::$app = Registry::getInstance();
        $this->getParams();
        Router::dispatch($query);
    }

    protected function getParams(): void
    {
        if (file_exists(CONFIG . '/params.php')) {
            $params = require_once CONFIG . '/params.php';
        }

        if (!empty($params)){
            foreach ($params as $key => $value){
                self::$app->setProperty($key, $value);
            }
        }
    }
}
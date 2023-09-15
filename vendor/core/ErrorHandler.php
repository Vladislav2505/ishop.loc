<?php

namespace core;

use JetBrains\PhpStorm\NoReturn;
use Throwable;

class ErrorHandler
{
    public function __construct()
    {
        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }

        set_exception_handler([$this, 'exceptionHandler']);
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }

    #[NoReturn] public function errorHandler(string $errno, string $errstr, string $errfile, string $errline): void
    {
        $this->logError($errstr, $errfile, $errline);
        $this->displayErrors($errno, $errstr, $errfile, $errline);
    }

    public function fatalErrorHandler(): void
    {
        $error = error_get_last();
        if (!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            $this->logError($error['message'], $error['file'], $error['line']);
            ob_end_clean();
            $this->displayErrors($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            ob_end_flush();
        }
    }

    #[NoReturn] public function exceptionHandler(Throwable $e): void
    {
        $this->logError($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayErrors('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function logError(string $message = '', string $file = '', string $line = ''): void
    {
        file_put_contents(LOGS . '/errors.log',
            "[" . date('Y-m-d H:i:s') . "] Текст ошибки: $message | Файл: $file | Строка: $line\n==========================\n", FILE_APPEND);
    }

    #[NoReturn] protected function displayErrors(string $errno, string $errstr,
                                                 string $errfile, string $errline, int $response = 500): void
    {
        if ($response == 0) {
            $response = 404;
        }

        http_response_code($response);

        if ($response == 404 && !DEBUG) {
            require WWW . '/errors/404.php';
            die;
        }

        if (DEBUG) {
            require WWW . '/errors/development.php';
        } else {
            require WWW . '/errors/production.php';
        }

        die;
    }
}
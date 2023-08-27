<?php

function debug($data, $die = false)
{
    echo '<pre>' . print_r($data, true) . '</pre>';
    if ($die) die;
}

function h(string $str): string
{
    return htmlspecialchars($str);
}

function redirect(string $http = null)
{
    if ($http) {
        $redirect = $http;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }

    header("Location: $redirect");
    die;
}

function baseUrl()
{
    return PATH . '/' . (\core\App::$app->getProperty('url_lang') ? \core\App::$app->getProperty('url_lang') . '/' : '');
}


/**
 * @param string $key Key of GET array
 * @param string $type Values 'i', 'f', 's'
 * @return float|int|string
 */
function get(string $key, string $type = 'i')
{
    $param = $_GET[$key] ?? '';

    if ($type == 'i') {
        return (int)$param;
    } elseif ($type == 'f') {
        return (float)$param;
    } else {
        return trim($param);
    }
}


/**
 * @param string $key Key of POST array
 * @param string $type Values 'i', 'f', 's'
 * @return float|int|string
 */
function post(string $key, string $type = 's')
{
    $param = $_POST[$key] ?? '';

    if ($type == 'i') {
        return (int)$param;
    } elseif ($type == 'f') {
        return (float)$param;
    } else {
        return trim($param);
    }
}
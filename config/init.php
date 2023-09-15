<?php

define("ROOT", dirname(__DIR__));
const DEBUG = 1;
const WWW = ROOT . '/public';
const APP = ROOT . '/app';
const CORE = ROOT . '/vendor/core';
const HELPERS = CORE . '/helpers';
const CACHE = ROOT . '/tmp/cache';
const LOGS = ROOT . '/tmp/logs';
const CONFIG = __DIR__;
const LAYOUT = 'ishop';
const PATH = 'http://ishop.loc';
const ADMIN = 'http://ishop.loc/admin';
const NO_IMAGE = 'uploads/no_image.jpg';

require_once ROOT . '/vendor/autoload.php';
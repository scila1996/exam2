<?php

namespace System\Core;

class Config
{

    /**
     *
     * @var boolean
     */
    public static $debug = true;

    /**
     *
     * @var string
     */
    public static $timezone = 'Asia/Ho_Chi_Minh';

    /**
     *
     * @var \System\Libraries\Router\RouteCollector
     */
    public static $route = null;

    /**
     *
     * @var array
     */
    public static $database = [
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => 3306,
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'database' => '',
        'prefix' => ''
    ];

}

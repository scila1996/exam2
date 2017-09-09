<?php

use System\Core\Config;
use System\Libraries\Router\RouteCollector;

Config::$route->get('/test', ['TestCtrl']);
Config::$route->get('/create-data', ['TestCtrl']);


// Asset Libs
Config::$route->get('/libs/{:.+\.\w+$}', ['Asset']);

// MiddleWare
Config::$route->filter('login', ['Users\\MiddleWare', 'requireLogin']);
Config::$route->filter('valid', ['Users\\MiddleWare', 'validLogin']);

// Login page
Config::$route->group(['before' => 'valid'], function(RouteCollector $routers) {
    // GET
    $routers->get('/user/login', ['Users\\LoginCtrl']);
    // POST
    $routers->post('/user/login', ['Users\\LoginCtrl', 'doPOST']);
});

Config::$route->group(['before' => 'login'], function(RouteCollector $routers) {
    $routers->get('/', ['Users\\HomeCtrl']);

    $routers->get('/user/files', ['Users\\FileCtrl']);

    $routers->any('/user/category/{:\d+}/create/', ['Users\\FileCtrl', 'createCategory']);

    $routers->get('/user/files/rest/{:\w+}', ['Users\\FileCtrl', 'rest']);

    $routers->get('/user/logout', ['Users\\LoginCtrl', 'logout']);
});

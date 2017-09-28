<?php

use System\Core\Config;
use System\Libraries\Router\RouteCollector;

Config::$route->get('/test', ['TestCtrl']);

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

    // GET tree data
    $routers->get('/user/files/{id:0}/{action:get}/tree', ['Users\\FileCtrl', 'category']);

    // Category manage
    $routers->any('/user/category/{id:\d+}/{action:create|edit|delete}', ['Users\\FileCtrl', 'category']);

    // Exam manage
    $routers->any('/user/exam/{id:\d+}/{action:edit|delete}', ['Users\\FileCtrl', 'exam']);

    $routers->get('/user/logout', ['Users\\LoginCtrl', 'logout']);
});

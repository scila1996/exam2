<?php

use System\Core\Config;
use Phroute\Phroute\RouteCollector;

Config::$route->get('/test', ['TestCtrl']);

// MiddleWare
Config::$route->filter('login', ['Users\MiddleWare', 'require_login']);
Config::$route->filter('valid', ['Users\MiddleWare', 'valid_login']);

// Login page
Config::$route->group(['before' => 'valid'], function(RouteCollector $routers) {
    $routers->get('/user/login', ['Users\LoginCtrl']);
    $routers->post('/user/login', ['Users\LoginCtrl', 'do_submit']);
});

// Manage

Config::$route->group(['before' => 'login'], function(RouteCollector $routers) {
    $routers->get('/', ['Users\HomeCtrl']);

    $routers->get('/user/files', ['Users\\FileCtrl']);

    // GET treeview data
    $routers->get('/user/files/{id:\d+}/get/tree', ['Users\\FileCtrl', 'ajax_get_category_data']);

    // Category manage
    $routers->get('/user/category/{id:\d+}/create', ['Users\\FileCtrl', 'add_category']);
    $routers->post('/user/category/{id:\d+}/create', ['Users\\FileCtrl', 'do_add_category']);

    $routers->get('/user/category/{id:\d+}/edit', ['Users\\FileCtrl', 'edit_category']);
    $routers->post('/user/category/{id:\d+}/edit', ['Users\\FileCtrl', 'do_edit_category']);

    $routers->get('/user/category/{id:\d+}/delete', ['Users\\FileCtrl', 'delete_category']);

    // Exam manage
    $routers->get('/user/category/{id:\d+}/exam/create', ['Users\\FileCtrl', 'create_exam']);
    $routers->post('/user/category/{id:\d+}/exam/create', ['Users\\FileCtrl', 'do_create_exam']);

    $routers->get('/user/category/{category:\d+}/exam/{id:\d+}/edit', ['Users\\FileCtrl', 'edit_exam']);
    $routers->post('/user/category/{category:\d+}/exam/{id:\d+}/edit', ['Users\\FileCtrl', 'do_edit_exam']);

    $routers->get('/user/category/{category:\d+}/exam/{id:\d+}/delete', ['Users\\FileCtrl', 'delete_exam']);

    //$routers->any('/user/exam/{id:\d+}/{action:edit|delete}', ['Users\\FileCtrl', 'exam']);
    // Question manage
    $routers->get('/user/exam/{exam_id:\d+}/question', ['Users\\QuizCtrl']);
    $routers->any('/user/exam/{exam_id:\d+}/question/create/{type}', ['Users\\QuizCtrl', 'create']);
    $routers->any('/user/exam/{exam_id:\d+}/question/{id:\d+}/{action:edit|delete}', ['Users\\QuizCtrl']);


    $routers->get('/user/profile', ['Users\\ProfileCtrl']);

    $routers->get('/user/profile/password', ['Users\\ProfileCtrl', 'change_password']);
    $routers->post('/user/profile/password', ['Users\\ProfileCtrl', 'do_change_password']);

    $routers->get('/user/profile/edit', ['Users\\ProfileCtrl', 'edit_info']);
    $routers->get('/user/logout', ['Users\\LoginCtrl', 'logout']);
});

<?php

/*
   |--------------------------------------------------------------------------
   | Web Routes
   |--------------------------------------------------------------------------
   |
   | Here is where you can register web routes for your application. These
   | routes are loaded by the Router class 
   |
   */

$router->get('', ['PagesController@home']);
$router->get('contact', ['PagesController@contact']);
$router->get('users', ['UsersController@index']);
$router->post('users', ['UsersController@store']);
$router->get('about', ['AuthMiddleware@validateSession', 'PagesController@about']);
$router->get('login', ['AuthsController@loginForm']);
$router->post('login', ['AuthsController@login']);

$router->get('dashboard', ['AuthMiddleware@validateSession', 'PagesController@dashboard']);

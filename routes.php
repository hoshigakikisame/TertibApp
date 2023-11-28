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

$router->get('/^$/', ['PagesController@home']);
$router->get('/^contact$/', ['PagesController@contact']);
$router->get('/^users$/', ['UsersController@index']);
$router->post('/^users$/', ['UsersController@store']);
$router->get('/^about$/', ['PagesController@about']);
$router->get('/^test\/(\d+)\/(\d+)$/', ['PagesController@test']);
$router->get('/^login$/', ['AuthsController@loginForm']);
$router->post('/^login$/', ['AuthsController@login']);

$router->get('/^dashboard$/', ['AuthMiddleware@validateSession', 'PagesController@dashboard']);
$router->get('/^report$/', ['AuthMiddleware@validateSession', 'PagesController@report']);
$router->get('/^notification$/', ['AuthMiddleware@validateSession', 'PagesController@notification']);
$router->get('/^profile$/', ['AuthMiddleware@validateSession', 'PagesController@profile']);
$router->get('/^logout$/', ['AuthMiddleware@validateSession', 'AuthsController@logout']);

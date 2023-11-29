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

$router->get('/^login$/', ['AuthMiddleware@shouldAnonymous', 'AuthsController@loginForm']);
$router->post('/^login$/', ['AuthMiddleware@shouldAnonymous', 'AuthsController@login']);
$router->get('/^change_password$/', ['AuthMiddleware@shouldAnonymous', 'PagesController@changePassword']);
$router->get('/^send_verification$/', ['AuthMiddleware@shouldAnonymous', 'PagesController@sendVerification']);



$router->get('/^dashboard$/', ['AuthMiddleware@shouldValidated', 'PagesController@dashboard']);
$router->get('/^report$/', ['AuthMiddleware@shouldValidated', 'PagesController@report']);
$router->get('/^notification$/', ['AuthMiddleware@shouldValidated', 'PagesController@notification']);
$router->get('/^profile$/', ['AuthMiddleware@shouldValidated', 'PagesController@profile']);
$router->get('/^logout$/', ['AuthMiddleware@shouldValidated', 'AuthsController@logout']);

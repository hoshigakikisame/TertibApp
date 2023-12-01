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

// global routes
$router->get('/^$/', ['GlobalController@landing']);
$router->get('/^contact$/', ['GlobalController@contact']);
$router->get('/^about$/', ['GlobalController@about']);
$router->get('/^test\/(\d+)\/(\d+)$/', ['GlobalController@test']);

// auth routes
$router->get('/^auth\/login$/', ['AuthMiddleware@shouldAnonymous', 'AuthsController@loginForm']);
$router->post('/^auth\/login$/', ['AuthMiddleware@shouldAnonymous', 'AuthsController@login']);
$router->get('/^auth\/update-password\/(\w{32})$/', ['AuthMiddleware@shouldAnonymous', 'AuthsController@updatePasswordView']);
$router->post('/^auth\/update-password$/', ['AuthMiddleware@shouldAnonymous', 'AuthsController@updatePassword']);
$router->get('/^auth\/forgot-password$/', ['AuthMiddleware@shouldAnonymous', 'AuthsController@forgotPasswordView']);
$router->post('/^auth\/forgot-password$/', ['AuthMiddleware@shouldAnonymous', 'AuthsController@forgotPassword']);
$router->get('/^auth\/logout$/', ['AuthMiddleware@shouldValidated', 'AuthsController@logout']);

// admin routes
$router->get('/^admin\/dashboard$/', ['AuthMiddleware@shouldValidated', 'AdminController@dashboard']);
$router->get('/^admin\/report$/', ['AuthMiddleware@shouldValidated', 'AdminController@report']);
$router->get('/^admin\/notification$/', ['AuthMiddleware@shouldValidated', 'AdminController@notification']);
$router->get('/^admin\/profile$/', ['AuthMiddleware@shouldValidated', 'AdminController@profilePage']);
$router->post('/^admin\/update-profile$/', ['AuthMiddleware@shouldValidated', 'AdminController@updateProfile']);
$router->get('/^admin\/manage\/student$/', ['AuthMiddleware@shouldValidated', 'AdminController@manageStudent']);

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
$router->post('/^admin\/update-password$/', ['AuthMiddleware@shouldValidated', 'AdminController@updatePassword']);
$router->get('/^admin\/manage\/student$/', ['AuthMiddleware@shouldValidated', 'AdminController@manageStudent']);
$router->get('/^admin\/manage\/lecture$/', ['AuthMiddleware@shouldValidated', 'AdminController@manageLecture']);
$router->get('/^admin\/manage\/admin$/', ['AuthMiddleware@shouldValidated', 'AdminController@manageAdmin']);
$router->post('/^admin\/manage\/admin\/new$/', ['AuthMiddleware@shouldValidated', 'AdminController@addNewAdmin']);
$router->post('/^admin\/manage\/admin\/update$/', ['AuthMiddleware@shouldValidated', 'AdminController@updateAdmin']);
$router->get('/^admin\/manage\/level-violation$/', ['AuthMiddleware@shouldValidated', 'AdminController@manageLevelViolation']);
$router->get('/^admin\/manage\/code-of-conduct$/', ['AuthMiddleware@shouldValidated', 'AdminController@manageCodeOfConduct']);

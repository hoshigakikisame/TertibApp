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

// manage student routes
$router->get('/^admin\/manage\/student$/', ['AuthMiddleware@shouldValidated', 'AdminController@manageStudent']);

// manage lecture routes
$router->get('/^admin\/manage\/lecture$/', ['AuthMiddleware@shouldValidated', 'AdminController@manageLecture']);

// manage admin routes
$router->get('/^admin\/manage\/admin$/', ['AuthMiddleware@shouldValidated', 'ManageAdminController@manageAdminPage']);
$router->post('/^admin\/manage\/admin\/new$/', ['AuthMiddleware@shouldValidated', 'ManageAdminController@addNewAdmin']);
$router->post('/^admin\/manage\/admin\/update$/', ['AuthMiddleware@shouldValidated', 'ManageAdminController@updateAdmin']);

// manage violation level routes
$router->get('/^admin\/manage\/violation-level$/', ['AuthMiddleware@shouldValidated', 'ManageViolationLevelController@manageViolationLevelPage']);
$router->post('/^admin\/manage\/violation-level\/new$/', ['AuthMiddleware@shouldValidated', 'ManageViolationLevelController@addViolationLevel']);
$router->post('/^admin\/manage\/violation-level\/update$/', ['AuthMiddleware@shouldValidated', 'ManageViolationLevelController@updateViolationLevel']);

// manage code of conduct routes
$router->get('/^admin\/manage\/code-of-conduct$/', ['AuthMiddleware@shouldValidated', 'ManageCodeOfConductController@manageCodeOfConductPage']);
$router->post('/^admin\/manage\/code-of-conduct\/new$/', ['AuthMiddleware@shouldValidated', 'ManageCodeOfConductController@addCodeOfConduct']);
$router->post('/^admin\/manage\/code-of-conduct\/update$/', ['AuthMiddleware@shouldValidated', 'ManageCodeOfConductController@updateCodeOfConduct']);

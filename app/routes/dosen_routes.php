<?php

$router->get('/^dosen\/dashboard$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'DosenController@dashboardPage']);
$router->get('/^dosen\/profile$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'DosenController@profilePage']);
$router->get('/^dosen\/report$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'DosenController@reportPage']);
$router->post('/^dosen\/report\/new$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'DosenController@addNewReport']);
$router->post('/^dosen\/update-profile$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'DosenController@updateProfile']);
$router->post('/^dosen\/update-password$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'DosenController@updatePassword']);

$router->get('/^dosen\/notification$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'DosenController@notificationPage']);

<?php

$router->get('/^dosen\/dashboard$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'DosenController@dashboardPage']);
$router->get('/^dosen\/profile$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'DosenController@profilePage']);
$router->post('/^dosen\/profile\/update$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'DosenController@updateProfile']);
$router->get('/^dosen\/report$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'DosenController@reportPage']);
$router->get('/^dosen\/report\/detail$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'DosenController@reportDetailPage']);

<?php

$router->get('/^dosen\/dashboard$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'DosenController@dashboardPage']);
$router->get('/^dosen\/profile$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'DosenController@profilePage']);
$router->get('/^dosen\/report$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'DosenController@reportPage']);
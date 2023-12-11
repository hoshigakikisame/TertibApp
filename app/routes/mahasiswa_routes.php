<?php

$router->get('/^mahasiswa\/dashboard$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldMahasiswa', 'MahasiswaController@dashboardPage']);
$router->get('/^mahasiswa\/profile$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldMahasiswa', 'MahasiswaController@profilePage']);
$router->post('/^mahasiswa\/profile\/update$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldMahasiswa', 'MahasiswaController@updateProfile']);
$router->get('/^mahasiswa\/report$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldMahasiswa', 'MahasiswaController@reportPage']);
$router->post('/^mahasiswa\/report\/new$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldMahasiswa', 'MahasiswaController@addNewReport']);

$router->get('/^mahasiswa\/notification$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldMahasiswa', 'MahasiswaController@notificationPage']);

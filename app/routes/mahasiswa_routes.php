<?php

$router->get('/^mahasiswa\/dashboard$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldMahasiswa', 'MahasiswaController@dashboardPage']);
$router->get('/^mahasiswa\/profile$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldMahasiswa', 'MahasiswaController@profilePage']);
$router->get('/^mahasiswa\/violation-history/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldMahasiswa', 'MahasiswaController@violationHistoryPage']);
$router->post('/^mahasiswa\/update-profile$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldMahasiswa', 'MahasiswaController@updateProfile']);
$router->post('/^mahasiswa\/update-password$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldMahasiswa', 'MahasiswaController@updatePassword']);

$router->get('/^mahasiswa\/notification$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldMahasiswa', 'MahasiswaController@notificationPage']);

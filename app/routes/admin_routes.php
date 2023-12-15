<?php

// admin routes
$router->get('/^admin\/dashboard$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'AdminController@dashboard']);
$router->get('/^admin\/report$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'AdminController@reportPage']);
$router->get('/^admin\/notification$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'AdminController@notificationPage']);
$router->get('/^admin\/logactivity$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'AdminController@logactivityPage']);
$router->get('/^admin\/profile$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'AdminController@profilePage']);
$router->post('/^admin\/update-profile$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'AdminController@updateProfile']);
$router->post('/^admin\/update-password$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'AdminController@updatePassword']);

// manage student routes
$router->get('/^admin\/manage\/mahasiswa$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageMahasiswaController@manageMahasiswaPage']);
$router->post('/^admin\/manage\/mahasiswa\/new$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageMahasiswaController@addNewMahasiswa']);
$router->post('/^admin\/manage\/mahasiswa\/update$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageMahasiswaController@updateMahasiswa']);
$router->post('/^admin\/manage\/mahasiswa\/delete$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageMahasiswaController@deleteMahasiswa']);

// manage dosen routes
$router->get('/^admin\/manage\/dosen$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageDosenController@manageDosenPage']);
$router->post('/^admin\/manage\/dosen\/new$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageDosenController@addNewDosen']);
$router->post('/^admin\/manage\/dosen\/update$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageDosenController@updateDosen']);
$router->post('/^admin\/manage\/dosen\/delete$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageDosenController@deleteDosen']);


// manage admin routes
$router->get('/^admin\/manage\/admin$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageAdminController@manageAdminPage']);
$router->post('/^admin\/manage\/admin\/new$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageAdminController@addNewAdmin']);
$router->post('/^admin\/manage\/admin\/update$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageAdminController@updateAdmin']);
$router->post('/^admin\/manage\/admin\/delete$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageAdminController@deleteAdmin']);

// manage violation level routes
$router->get('/^admin\/manage\/violation-level$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageViolationLevelController@manageViolationLevelPage']);
$router->post('/^admin\/manage\/violation-level\/new$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageViolationLevelController@addViolationLevel']);
$router->post('/^admin\/manage\/violation-level\/update$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageViolationLevelController@updateViolationLevel']);
$router->post('/^admin\/manage\/violation-level\/delete$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageViolationLevelController@deleteViolationLevel']);

// manage code of conduct routes
$router->get('/^admin\/manage\/code-of-conduct$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageCodeOfConductController@manageCodeOfConductPage']);
$router->post('/^admin\/manage\/code-of-conduct\/new$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageCodeOfConductController@addCodeOfConduct']);
$router->post('/^admin\/manage\/code-of-conduct\/update$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageCodeOfConductController@updateCodeOfConduct']);
$router->post('/^admin\/manage\/code-of-conduct\/delete$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldAdmin', 'ManageCodeOfConductController@deleteCodeOfConduct']);

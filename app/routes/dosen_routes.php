<?php

$router->get('/^dosen\/dashboard$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'DosenController@dashboardPage']);
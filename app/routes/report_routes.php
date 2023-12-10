<?php

$router->get('/^report\/detail\/(\d+)$/', ['AuthMiddleware@shouldValidated', 'RoleMiddleware@shouldDosen', 'ReportController@reportDetailPage']);
<?php

$router->get('/^report\/detail\/(\d+)$/', ['AuthMiddleware@shouldValidated', 'ReportController@reportDetailPage']);
$router->post('/^report\/detail\/(\d+)\/comment\/new$/', ['AuthMiddleware@shouldValidated', 'ReportController@addNewReportComment']);
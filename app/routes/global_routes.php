<?php

// global routes
$router->get('/^$/', ['GlobalController@landing']);
$router->get('/^contact$/', ['GlobalController@contact']);
$router->get('/^stats$/', ['GlobalController@stats']);
$router->get('/^about$/', ['GlobalController@about']);
// $router->get('/^test\/(\d+)\/(\d+)$/', ['GlobalController@test']);
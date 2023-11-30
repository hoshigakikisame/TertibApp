<?php

/**
 * Register bindings in the app's service container.
 * More may be added by following the convention that's used.
 */

/**
 * @var array $config
 */

$config = require 'config.php';

App::bind('config', $config);

App::bind(
	'database',
	new QueryBuilder(
		Connection::make($config['database'])
	)
);

App::bind(('host'), $config['host']);

App::bind('root_uri', $config['root_uri']);

App::bind('router', Router::getInstance());

App::bind('email_api', EmailApi::getInstance());
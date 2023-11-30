<?php

/**
 * @author AKEEM AMUSAT
 * @copyright Bigbang Inc.
 * @license license https://github.com/dev-haykay/MVCBoilerplate/blob/master/LICENSE MIT Licence
 */
require 'vendor/autoload.php';
require 'app/core/bootstrap.php';

/**
 * @var array $config
 */
$config = App::get('config');

date_default_timezone_set($config['timezone']);
Session::getInstance();
Router::load('routes.php')->direct(Request::uri(), Request::method());

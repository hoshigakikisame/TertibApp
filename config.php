<?php
/*
   |--------------------------------------------------------------------------------------
   | Database Configuration
   |--------------------------------------------------------------------------------------
   |
   | Here you can configure your application database and its settings.
   |
   | 'name'        => 	string 		The name of the database.
   | 'host'        => 	string 		The database host.
   | 'username'	=> 	string 		The database username.
   | 'password'    => 	string 		The database password.
   | 'options '	=> 	array 		An array of extra attributes on the database handle.
   |                         		Refer to http://php.net/manual/en/pdo.setattribute.php.
   |
   */
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

return [
	'database' => [
      'name' => $_ENV['DB_NAME'],
		'host' => $_ENV['DB_HOST'],
      'port' => $_ENV['DB_PORT'],
		'username' => $_ENV['DB_USER'],
		'password' => $_ENV['DB_PASSWORD'],
		'options' => array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
         PDO::MYSQL_ATTR_SSL_CA => "../../../database_ca.pem",
         PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
      )
	],
   'host' => $_ENV['HOST'],
	'root_uri' => dirname($_SERVER['SCRIPT_NAME']),
   'mailjet' => [
      'api_key' => $_ENV['MAILJET_API_KEY'],
      'secret_key' => $_ENV['MAILJET_SECRET_KEY'],
      'sender_email' => $_ENV['MAILJET_SENDER_EMAIL'],
      'sender_name' => $_ENV['MAILJET_SENDER_NAME'],
   ],
   'timezone' => 'Asia/Jakarta',
   'recovery_token_validity' => 60 * 60, // in seconds
   'password_algorithm' => PASSWORD_BCRYPT
];
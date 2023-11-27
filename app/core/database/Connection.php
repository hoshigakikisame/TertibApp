<?php


class Connection
{
	public static function make(array $config)
	{
		try {
			return new PDO(
				'mysql:host=' . $config['host'] . ';dbname=' . $config['name'] . ';port=' . $config['port'],
				$config['username'],
				$config['password'],
				$config['options']
			);
		} catch
		(PDOException $e) {
			// dd($e);
			echo $e->getMessage();
			die();
		}
	}
}
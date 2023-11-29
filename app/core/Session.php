<?php


class Session
{

	/**
	 * Push new item into the global $_SESSION variable
	 *
	 * @param  string $name name of the item
	 * @param  mixed $data item to be pushed
	 * @return null      
	 */

	private static $instances = [];

	protected function __construct()
	{
		session_start();
	}

	protected function __clone()
	{
	}

	public function __wakeup()
	{
		throw new \Exception("Cannot unserialize a singleton.");
	}

	public static function getInstance(): Session
	{
		$cls = static::class;
		if (!isset(self::$instances[$cls])) {
			self::$instances[$cls] = new static();
		}

		return self::$instances[$cls];
	}


	public function push(string $name, $data)
	{
		$_SESSION[$name] = $data;
	}

	public function pop(string $name)
	{
		if (self::has($name)) {
			$data = $_SESSION[$name];
			unset($_SESSION[$name]);
			return $data;
		}
		throw new Exception();
	}

	/**
	 * Retrieve an item from the global $_SESSION variable
	 *
	 * @param  string $name
	 * @throws Exception
	 * @return mixed       
	 */
	public function get(string $name)
	{
		if (self::has($name)) {
			return $_SESSION[$name];
		}
		throw new Exception();
	}

	/**
	 * Check if an item exists in the global $_SESSION variable
	 *
	 * @param  string  $name item name
	 * @return boolean       
	 */
	public function has(string $name): bool
	{
		if (array_key_exists($name, $_SESSION)) {
			return true;
		}

		return false;
	}
}

<?php


class Router
{
	public $routes = array(
		'GET' => [],
		'POST' => [],
		'PUT' => [],
		'DELETE' => [],
		'PATCH' => [],
		"HEAD" => []
	);

	private static $instances = [];

	protected function __construct(){}

	protected function __clone()
	{
	}

	public function __wakeup()
	{
		throw new \Exception("Cannot unserialize a singleton.");
	}

	public static function getInstance(): Router
	{
		$cls = static::class;
		if (!isset(self::$instances[$cls])) {
			self::$instances[$cls] = new static();
		}

		return self::$instances[$cls];
	}

	/**
	 * Route registrar
	 * @param  array $routes
	 */
	public function register($routes)
	{
		$this->routes = $routes;
	}

	/**
	 * Forward HTTP Requests to a controller method
	 *
	 * @param  string $uri
	 * @param  string $requestType
	 * @throws Exception
	 * @return null
	 */
	public function direct($requestUri, $requestType)
	{
		foreach ($this->routes[$requestType] as $routeUri => $actions) {
			if (preg_match_all($routeUri, $requestUri, $matches)) {
				$rawParams = array_slice($matches, 1);
				$params = [];

				foreach ($rawParams as $k => $v) {
					$params[$k] = $v[0];
				}

				$actions = $this->routes[$requestType][$routeUri];

				for ($i = 0; $i < count($actions); $i++) {
					$action = explode('@', $actions[$i]);
					$class = $action[0];
					$method = $action[1];
					$this->callAction(
						$class,
						$method,
						$params
					);
				}
				return;
			}
		}
		http_response_code(404);
		throw new Exception("Route: " . $requestUri . " not found!");
	}

	/**
	 * Call the specified controller method
	 *
	 * @param  string $controller [description]
	 * @param  string $method     [description]
	 * @throws Exception
	 * @return [type]             [description]
	 */
	protected function callAction(string $controller, string $method, $parameters = [])
	{
		if (!method_exists($controller, $method)) {
			http_response_code(500);
			throw new Exception($method . " not define on " . $controller);
		}

		$method = new ReflectionMethod($controller, $method);
		if ($method->getNumberOfParameters() > 0) {
			return $method->invokeArgs(new $controller, $parameters);
		} 

		return $method->invoke(new $controller);
	}

	/**
	 * Handles http get requests
	 *
	 * @param  string $uri
	 * @param  string $controller
	 * @return null
	 */
	public function get($uri, $actions)
	{
		$this->routes['GET'][$uri] = $actions;
	}

	/**
	 * Handles HTTP POST Requests
	 *
	 * @param  string $uri
	 * @param  string $controller
	 * @return null
	 */
	public function post($uri, $actions)
	{
		$this->routes['POST'][$uri] = $actions;
	}

	/**
	 * Handles HTTP PUT Requests
	 *
	 * @param  string $uri
	 * @param  string $controller
	 * @return null
	 */
	public function put($uri, $actions)
	{
		$this->routes['PUT'][$uri] = $actions;
	}

	/**
	 * Handles HTTP DELETE Requests
	 *
	 * @param  string $uri
	 * @param  string $controller
	 * @return mixed
	 */
	public function delete($uri, $actions)
	{
		$this->routes['DELETE'][$uri] = $actions;
	}

	/**
	 * Handles HTTP PATCH Requests
	 *
	 * @param  string $uri
	 * @param  string $controller
	 * @return mixed
	 */
	public function patch($uri, $actions)
	{
		$this->routes['PATCH'][$uri] = $actions;
	}

	/**
	 * Handles HTTP HEAD Requests
	 *
	 * @param  string $uri
	 * @param  string $controller
	 * @return mixed
	 */
	public function head($uri, $actions)
	{
		$this->routes['HEAD'][$uri] = $actions;
	}

	/**
	 * Load route file
	 *
	 * @param  string $file
	 * @return Router instance
	 */
	public static function load($file)
	{
		$router = self::getInstance();
		require $file;
		return $router;
	}
}

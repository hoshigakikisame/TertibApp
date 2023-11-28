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
	public function direct($uri, $requestType)
	{
		foreach ($this->routes[$requestType] as $key => $value) {
			if (preg_match_all($key, $uri, $matches)) {
				$rawParams = array_slice($matches, 1);
				$params = [];

				foreach ($rawParams as $k => $v) {
					$params[$k] = $v[0];
				}

				$actions = $this->routes[$requestType][$key];

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
		throw new Exception("Route: " . $uri . " not found!");
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
		return (new $controller)->$method(...$parameters);
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
		// $this->routes['GET'][$uri] = $controller;
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
	public function put($uri, $controller)
	{
		$this->routes['PUT'][$uri] = $controller;
	}

	/**
	 * Handles HTTP DELETE Requests
	 *
	 * @param  string $uri
	 * @param  string $controller
	 * @return mixed
	 */
	public function delete($uri, $controller)
	{
		$this->routes['DELETE'][$uri] = $controller;
	}

	/**
	 * Handles HTTP PATCH Requests
	 *
	 * @param  string $uri
	 * @param  string $controller
	 * @return mixed
	 */
	public function patch($uri, $controller)
	{
		$this->routes['PATCH'][$uri] = $controller;
	}

	/**
	 * Handles HTTP HEAD Requests
	 *
	 * @param  string $uri
	 * @param  string $controller
	 * @return mixed
	 */
	public function head($uri, $controller)
	{
		$this->routes['HEAD'][$uri] = $controller;
	}

	/**
	 * Load route file
	 *
	 * @param  string $file
	 * @return Router instance
	 */
	public static function load($file)
	{
		$router = new self;
		require $file;
		return $router;
	}
}
